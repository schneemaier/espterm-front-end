const EventEmitter = require('events')
const $ = require('../lib/chibi')
let demo
try { demo = require('./demo') } catch (err) {}

/** Handle connections */
module.exports = class TermConnection extends EventEmitter {
  constructor (screen) {
    super()

    this.screen = screen
    this.ws = null
    this.heartbeatTimeout = null
    this.pingInterval = null
    this.xoff = false
    this.autoXoffTimeout = null
    this.reconnTimeout = null
    this.forceClosing = false

    this.pageShown = false

    this.disconnectTimeout = null

    document.addEventListener('visibilitychange', () => {
      if (document.hidden === true) {
        console.info('Window lost focus, freeing socket')
        // Delayed, avoid disconnecting if the background time is short
        this.disconnectTimeout = setTimeout(() => {
          this.closeSocket()
          clearTimeout(this.heartbeatTimeout)
        }, 1000)
      } else {
        clearTimeout(this.disconnectTimeout)
        console.info('Window got focus, re-connecting')
        this.init()
      }
    }, false)
  }

  onWSOpen (evt) {
    console.log('CONNECTED')
    this.heartbeat()
    this.send('i')
    this.forceClosing = false

    this.emit('connect')
  }

  onWSClose (evt) {
    if (this.forceClosing) {
      this.forceClosing = false
      return
    }
    console.warn('SOCKET CLOSED, code ' + evt.code + '. Reconnecting...')
    if (evt.code < 1000) {
      console.error('Bad code from socket!')
      // this sometimes happens for unknown reasons, code < 1000 is invalid
      // location.reload()
    }

    clearTimeout(this.reconnTimeout)
    this.reconnTimeout = setTimeout(() => this.init(), 2000)

    this.emit('disconnect', evt.code)
  }

  onWSMessage (evt) {
    try {
      switch (evt.data.charAt(0)) {
        case '.':
          // heartbeat, no-op message
          break

        case '-':
          // console.log('xoff');
          this.xoff = true
          this.autoXoffTimeout = setTimeout(() => {
            this.xoff = false
          }, 250)
          break

        case '+':
          // console.log('xon');
          this.xoff = false
          clearTimeout(this.autoXoffTimeout)
          break

        default:
          this.screen.load(evt.data)
          if (!this.pageShown) {
            window.showPage()
            this.pageShown = true
          }
          break
      }
      this.heartbeat()
    } catch (e) {
      console.error(e)
    }
  }

  canSend () {
    return !this.xoff
  }

  send (message) {
    if (window._demo) {
      if (typeof window.demoInterface !== 'undefined') {
        demo.input(message)
      } else {
        console.log(`TX: ${JSON.stringify(message)}`)
      }
      return true // Simulate success
    }
    if (this.xoff) {
      // TODO queue
      console.log("Can't send, flood control.")
      return false
    }

    if (!this.ws) return false // for dry testing
    if (this.ws.readyState !== 1) {
      console.error('Socket not ready')
      return false
    }
    if (typeof message !== 'string') {
      message = JSON.stringify(message)
    }
    this.ws.send(message)
    return true
  }

  /** Safely close the socket */
  closeSocket () {
    if (this.ws) {
      this.forceClosing = true
      if (this.ws.readyState === 1) this.ws.close()
      this.ws = null
    }
  }

  init () {
    if (window._demo) {
      if (typeof window.demoInterface === 'undefined') {
        window.alert('Demoing non-demo build!') // this will catch mistakes when deploying to the website
      } else {
        demo.init(this.screen)
      }
      return
    }

    clearTimeout(this.reconnTimeout)
    clearTimeout(this.heartbeatTimeout)

    this.closeSocket()

    this.ws = new window.WebSocket('ws://' + window._root + '/term/update.ws')
    this.ws.addEventListener('open', (...args) => this.onWSOpen(...args))
    this.ws.addEventListener('close', (...args) => this.onWSClose(...args))
    this.ws.addEventListener('message', (...args) => this.onWSMessage(...args))
    console.log('Opening socket.')
    this.heartbeat()

    this.emit('open')
  }

  heartbeat () {
    clearTimeout(this.heartbeatTimeout)
    this.heartbeatTimeout = setTimeout(() => this.onHeartbeatFail(), 2500)
  }

  onHeartbeatFail () {
    this.closeSocket()
    this.emit('silence')
    console.error('Heartbeat lost, probing server...')
    clearInterval(this.pingInterval)

    this.pingInterval = setInterval(() => {
      console.log('> ping')
      this.emit('ping')
      $.get('http://' + window._root + '/system/ping', (resp, status) => {
        if (status === 200) {
          clearInterval(this.pingInterval)
          console.info('Server ready, opening socket…')
          this.emit('ping-success')
          this.init()
          // location.reload()
        } else this.emit('ping-fail', status)
      }, {
        timeout: 100,
        loader: false // we have loader on-screen
      })
    }, 1000)
  }
}
