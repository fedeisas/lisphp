# LisPHP

[![Build Status](https://travis-ci.org/fedeisas/lisphp.svg?branch=master)](https://travis-ci.org/fedeisas/lisphp)
[![StyleCI](https://styleci.io/repos/76986852/shield?branch=master)](https://styleci.io/repos/76986852)

## What's this

This is the code I'm using for my 2nd interview at [Recurse Center](https://www.recurse.com/).

> Write code that takes some Lisp code and returns an abstract syntax tree. The AST should represent the structure of the code and the meaning of each token. For example, if your code is given "(first (list 1 (+ 2 3) 9))", it could return a nested array like ["first", ["list", 1, ["+", 2, 3], 9]]. During your interview, you will pair on writing an interpreter to run the AST. You can start by implementing a single built-in function (for example, +) and add more if you have time.

## Inspiration

- [(How to Write a (Lisp) Interpreter (in Python))](http://norvig.com/lispy.html)
- [Igor Wiedler - Lisp at Laracon EU 2014](https://www.youtube.com/watch?v=FRaNUsiD_BA)
- [Learn You Some Lisp for Great Good](https://www.youtube.com/watch?v=3T00X_sNg4Q)