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
   1C                      Erlang                  Parser3
   ActionScript            Erlang REPL             Perl
   Apache                  F#                      PHP
   AppleScript             GLSL                    Python profile
   ASCII Doc               Go                      Python
   AVR Asm                 HAML                    R
   Axapta                  Haskell                 RenderMan RSL
   Bash                    HTTP                    RenderMan RIB
   Brainfuck               Ini                     Ruby
   Clojure                 Java                    Rules
   CMake                   JavaScript              Rust
   CoffeeScript            JSON                    Scala
   C++                     Lasso                   SCSS
   C#                      Lisp                    Smalltalk
   CSS                     Lua                     SQL
   Delphi                  Markdown                TeX
   Diff                    MatLab                  Vala
   Django                  MEL                     VisualBasic.NET
   D                       Nginx                   VBscript
   Dos                     Objective C             VHDL
                                                   HTML/XML
====================    ====================    ====================


Installation
````````````

1. Upload ``wp-highlight.js`` to the ``/wp-content/plugins/`` directory.
2. Activate the plugin through the **Plugins** menu in WordPress
3. Use ``[code lang="some_lang"]some code[/code]`` construction for specific
   languange highlighting or ``[code]some code[/code]`` for highlighting with
   language autodetection. Also you can use ``<pre><code>`` tags instead
   ``[code]`` BB-tag.


Meta
````

:Author:        `Igor Kalnitsky <http://kalnitsky.org/about/en/>`_
:Plugin URL:    `wordpress site <http://wordpress.org/extend/plugins/wp-highlightjs/>`_

:Version:       0.3.1
:License:       BSD
