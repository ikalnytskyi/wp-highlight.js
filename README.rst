wp-highlight.js
===============

This is a simple WordPress_ plugin for highlight.js_ library. Highlight.js
highlights syntax in code examples on blogs, forums and in fact on any web
pages. It's very easy to use because it works automatically: finds blocks of
code, detects a language, highlights it.

.. _WordPress:    http://wordpress.org/
.. _highlight.js: http://softwaremaniacs.org/soft/highlight/en/


Features
````````

* works with comments
* high performance
* nice colorshemes


Languages
`````````

====================    ====================    ====================
  1C                      ActionScript            Apache
  AppleScript             ASCII Doc               AVR Asm
  Axapta                  Bash                    Brainfuck
  Clojure                 CMake                   CoffeeScript
  C++                     C#                      CSS
  D                       Delphi                  Diff
  Django                  DOS                     Erlang REPL
  Erlang                  F#                      GLSL
  Go                      HAML                    Handlebars
  Haskell                 HTML/XML                HTTP
  INI                     Java                    JavaScript
  JSON                    Lasso                   Lisp
  LiveCode Server         Lua                     Makefile
  Markdown                MatLab                  MEL
  Mizar                   Nginx                   Objective-C
  OCaml                   Parser3                 Perl
  PHP                     Python's profiler       Python
  R                       RenderMan RIB           RenderMan RSL
  Ruby                    Rules                   Rust
  Scala                   SciLab                  SCSS
  Smalltalk               SQL                     TeX
  Vala                    VisualBasic .NET        VBscript
  VHDL                    Oxygene                 Mathematica
====================    ====================    ====================


Installation
````````````

1. Upload ``wp-highlight.js`` to the ``/wp-content/plugins/`` directory.
2. Activate the plugin through the **Plugins** menu in WordPress
3. Use ``[code lang="some_lang"]some code[/code]`` construction for specific
   languange highlighting or ``[code]some code[/code]`` for highlighting with
   language autodetection. Also you can use ``<pre><code>`` tags instead
   ``[code]`` BB-tag.


Localization
````````````

:Spanish:   Andrew Kurtis and WebHostingHub_

.. _WebHostingHub:  http://www.webhostinghub.com/


Meta
````

:Author:        `Igor Kalnitsky <http://kalnitsky.org/about/en/>`_
:Plugin URL:    `wordpress site <http://wordpress.org/extend/plugins/wp-highlightjs/>`_

:Version:       0.3.4
:License:       BSD
