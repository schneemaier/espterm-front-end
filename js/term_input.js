/**
 * User input
 *
 * --- Rx messages: ---
 * S - screen content (binary encoding of the entire screen with simple compression)
 * T - text labels - Title and buttons, \0x01-separated
 * B - beep
 * . - heartbeat
 *
 * --- Tx messages ---
 * s - string
 * b - action button
 * p - mb press
 * r - mb release
 * m - mouse move
 */
window.Input = function (conn) {
  let opts = {
    np_alt: false,
    cu_alt: false,
    fn_alt: false,
    mt_click: false,
    mt_move: false,
    no_keys: false,
    crlf_mode: false
  }

  /** Send a literal message */
  function sendStrMsg (str) {
    return conn.send('s' + str)
  }

  /** Send a button event */
  function sendBtnMsg (n) {
    conn.send('b' + Chr(n))
  }

  /** Fn alt choice for key message */
  function fa (alt, normal) {
    return opts.fn_alt ? alt : normal
  }

  /** Cursor alt choice for key message */
  function ca (alt, normal) {
    return opts.cu_alt ? alt : normal
  }

  /** Numpad alt choice for key message */
  function na (alt, normal) {
    return opts.np_alt ? alt : normal
  }

  function _bindFnKeys () {
    const keymap = {
      'tab': '\x09',
      'backspace': '\x08',
      'enter': opts.crlf_mode ? '\x0d\x0a' : '\x0d',
      'ctrl+enter': '\x0a',
      'esc': '\x1b',
      'up': ca('\x1bOA', '\x1b[A'),
      'down': ca('\x1bOB', '\x1b[B'),
      'right': ca('\x1bOC', '\x1b[C'),
      'left': ca('\x1bOD', '\x1b[D'),
      'home': ca('\x1bOH', fa('\x1b[H', '\x1b[1~')),
      'insert': '\x1b[2~',
      'delete': '\x1b[3~',
      'end': ca('\x1bOF', fa('\x1b[F', '\x1b[4~')),
      'pageup': '\x1b[5~',
      'pagedown': '\x1b[6~',
      'f1': fa('\x1bOP', '\x1b[11~'),
      'f2': fa('\x1bOQ', '\x1b[12~'),
      'f3': fa('\x1bOR', '\x1b[13~'),
      'f4': fa('\x1bOS', '\x1b[14~'),
      'f5': '\x1b[15~', // note the disconnect
      'f6': '\x1b[17~',
      'f7': '\x1b[18~',
      'f8': '\x1b[19~',
      'f9': '\x1b[20~',
      'f10': '\x1b[21~', // note the disconnect
      'f11': '\x1b[23~',
      'f12': '\x1b[24~',
      'shift+f1': fa('\x1bO1;2P', '\x1b[25~'),
      'shift+f2': fa('\x1bO1;2Q', '\x1b[26~'), // note the disconnect
      'shift+f3': fa('\x1bO1;2R', '\x1b[28~'),
      'shift+f4': fa('\x1bO1;2S', '\x1b[29~'), // note the disconnect
      'shift+f5': fa('\x1b[15;2~', '\x1b[31~'),
      'shift+f6': fa('\x1b[17;2~', '\x1b[32~'),
      'shift+f7': fa('\x1b[18;2~', '\x1b[33~'),
      'shift+f8': fa('\x1b[19;2~', '\x1b[34~'),
      'shift+f9': fa('\x1b[20;2~', '\x1b[35~'), // 35-38 are not standard - but what is?
      'shift+f10': fa('\x1b[21;2~', '\x1b[36~'),
      'shift+f11': fa('\x1b[22;2~', '\x1b[37~'),
      'shift+f12': fa('\x1b[23;2~', '\x1b[38~'),
      'np_0': na('\x1bOp', '0'),
      'np_1': na('\x1bOq', '1'),
      'np_2': na('\x1bOr', '2'),
      'np_3': na('\x1bOs', '3'),
      'np_4': na('\x1bOt', '4'),
      'np_5': na('\x1bOu', '5'),
      'np_6': na('\x1bOv', '6'),
      'np_7': na('\x1bOw', '7'),
      'np_8': na('\x1bOx', '8'),
      'np_9': na('\x1bOy', '9'),
      'np_mul': na('\x1bOR', '*'),
      'np_add': na('\x1bOl', '+'),
      'np_sub': na('\x1bOS', '-'),
      'np_point': na('\x1bOn', '.'),
      'np_div': na('\x1bOQ', '/')
      // we don't implement numlock key (should change in numpad_alt mode, but it's even more useless than the rest)
    }

    for (let k in keymap) {
      if (keymap.hasOwnProperty(k)) {
        bind(k, keymap[k])
      }
    }
  }

  /** Bind a keystroke to message */
  function bind (combo, str) {
    // mac fix - allow also cmd
    if (combo.indexOf('ctrl+') !== -1) {
      combo += ',' + combo.replace('ctrl', 'command')
    }

    // unbind possible old binding
    key.unbind(combo)

    key(combo, function (e) {
      if (opts.no_keys) return
      e.preventDefault()
      sendStrMsg(str)
    })
  }

  /** Bind/rebind key messages */
  function _initKeys () {
    // This takes care of text characters typed
    window.addEventListener('keypress', function (evt) {
      if (opts.no_keys) return
      let str = ''
      if (evt.key) str = evt.key
      else if (evt.which) str = String.fromCodePoint(evt.which)
      if (str.length > 0 && str.charCodeAt(0) >= 32) {
        // console.log("Typed ", str);
        // prevent space from scrolling
        if (evt.which === 32) evt.preventDefault()
        sendStrMsg(str)
      }
    })

    // ctrl-letter codes are sent as simple low ASCII codes
    for (let i = 1; i <= 26; i++) {
      bind('ctrl+' + String.fromCharCode(96 + i), String.fromCharCode(i))
    }
    /* eslint-disable */
    bind('ctrl+]',  '\x1b') // alternate way to enter ESC
    bind('ctrl+\\', '\x1c')
    bind('ctrl+[',  '\x1d')
    bind('ctrl+^',  '\x1e')
    bind('ctrl+_',  '\x1f')

    // extra ctrl-
    bind('ctrl+left',  '\x1f[1;5D')
    bind('ctrl+right', '\x1f[1;5C')
    bind('ctrl+up',    '\x1f[1;5A')
    bind('ctrl+down',  '\x1f[1;5B')
    bind('ctrl+home',  '\x1f[1;5H')
    bind('ctrl+end',   '\x1f[1;5F')

    // extra shift-
    bind('shift+left',  '\x1f[1;2D')
    bind('shift+right', '\x1f[1;2C')
    bind('shift+up',    '\x1f[1;2A')
    bind('shift+down',  '\x1f[1;2B')
    bind('shift+home',  '\x1f[1;2H')
    bind('shift+end',   '\x1f[1;2F')

    // macOS editing commands
    bind('⌥+left',      '\x1bb')    // ⌥← to go back a word (^[b)
    bind('⌥+right',     '\x1bf')    // ⌥→ to go forward one word (^[f)
    bind('⌘+left',      '\x01')     // ⌘← to go to the beginning of a line (^A)
    bind('⌘+right',     '\x05')     // ⌘→ to go to the end of a line (^E)
    bind('⌥+backspace', '\x17') // ⌥⌫ to delete a word (^W, I think)
    bind('⌘+backspace', '\x15') // ⌘⌫ to delete to the beginning of a line (possibly ^U)
    /* eslint-enable */

    _bindFnKeys()
  }

  // mouse button states
  let mb1 = 0
  let mb2 = 0
  let mb3 = 0

  /** Init the Input module */
  function init () {
    _initKeys()

    // Button presses
    $('#action-buttons button').forEach(function (s) {
      s.addEventListener('click', function () {
        sendBtnMsg(+this.dataset['n'])
      })
    })

    // global mouse state tracking - for motion reporting
    window.addEventListener('mousedown', function (evt) {
      if (evt.button === 0) mb1 = 1
      if (evt.button === 1) mb2 = 1
      if (evt.button === 2) mb3 = 1
    })

    window.addEventListener('mouseup', function (evt) {
      if (evt.button === 0) mb1 = 0
      if (evt.button === 1) mb2 = 0
      if (evt.button === 2) mb3 = 0
    })
  }

  /** Prepare modifiers byte for mouse message */
  function packModifiersForMouse () {
    return (key.isModifier('ctrl') ? 1 : 0) |
      (key.isModifier('shift') ? 2 : 0) |
      (key.isModifier('alt') ? 4 : 0) |
      (key.isModifier('meta') ? 8 : 0)
  }

  return {
    /** Init the Input module */
    init: init,

    /** Send a literal string message */
    sendString: sendStrMsg,

    /** Enable alternate key modes (cursors, numpad, fn) */
    setAlts: function (cu, np, fn, crlf) {
      if (opts.cu_alt !== cu || opts.np_alt !== np || opts.fn_alt !== fn || opts.crlf_mode !== crlf) {
        opts.cu_alt = cu
        opts.np_alt = np
        opts.fn_alt = fn
        opts.crlf_mode = crlf

        // rebind keys - codes have changed
        _bindFnKeys()
      }
    },

    setMouseMode: function (click, move) {
      opts.mt_click = click
      opts.mt_move = move
    },

    // Mouse events
    onMouseMove: function (x, y) {
      if (!opts.mt_move) return
      const b = mb1 ? 1 : mb2 ? 2 : mb3 ? 3 : 0
      const m = packModifiersForMouse()
      conn.send('m' + encode2B(y) + encode2B(x) + encode2B(b) + encode2B(m))
    },

    onMouseDown: function (x, y, b) {
      if (!opts.mt_click) return
      if (b > 3 || b < 1) return
      const m = packModifiersForMouse()
      conn.send('p' + encode2B(y) + encode2B(x) + encode2B(b) + encode2B(m))
      // console.log("B ",b," M ",m);
    },

    onMouseUp: function (x, y, b) {
      if (!opts.mt_click) return
      if (b > 3 || b < 1) return
      const m = packModifiersForMouse()
      conn.send('r' + encode2B(y) + encode2B(x) + encode2B(b) + encode2B(m))
      // console.log("B ",b," M ",m);
    },

    onMouseWheel: function (x, y, dir) {
      if (!opts.mt_click) return
      // -1 ... btn 4 (away from user)
      // +1 ... btn 5 (towards user)
      const m = packModifiersForMouse()
      const b = (dir < 0 ? 4 : 5)
      conn.send('p' + encode2B(y) + encode2B(x) + encode2B(b) + encode2B(m))
      // console.log("B ",b," M ",m);
    },

    mouseTracksClicks: function () {
      return opts.mt_click
    },

    blockKeys: function (yes) {
      opts.no_keys = yes
    }
  }
}