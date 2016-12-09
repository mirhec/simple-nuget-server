Simple NuGet Server
===================

A very simple NuGet server for my personal use, similar to
[NuGet.Server](https://www.nuget.org/packages/NuGet.Server) but in PHP. Designed
for scenarios where a single user (ie. a person or a build server) pushes
packages.

Features
========
 - Basic searching and listing of packages
 - Pushing via NuGet command line (NuGet.exe)
 - Simple set up
 - Stores data in SQLite or MySQL database
 - Uses a single API key (so not suitable for scenarios where multiple users
   need to be able to push packages)

Setup (with apache server hosted on Uberspace)
=====

1 - Create your own php.ini as described [here](https://wiki.uberspace.de/development:php#eigene_phpini) and make the following changes:

 - Increase the `upload_max_filesize` property to 290M
 - Increase the `post_max_size` property to 300M
 - Increase the `max_execution_time` to 300
 - Increase the `max_input_time` to 600
 - Increase the `memory_limit` to 512M

2 - Copy app to your server, you could do a Git clone on the server or add it as a Git submodule if adding to a site that's already managed via Git:
```bash
cd /var/www/virtual/$USER/html
git clone https://github.com/mirhec/simple-nuget-server.git
# Make db and packages directories writable
chmod 0770 db packagefiles
```

3 - Edit `inc/config.php` and change `ChangeThisKey` to a [randomly-generated string](https://www.random.org/strings/)

6 - Set the API key and test it out. I test using [nuget.exe](https://docs.nuget.org/consume/command-line-reference) (which is required for pushing)
```
nuget.exe setApiKey -Source http://example.com/ ChangeThisKey
nuget.exe push Foo.nupkg -Source http://example.com/
```
(if using Mono, run `mono nuget.exe` instead)

Examples
========
[ReactJS.NET](http://reactjs.net/) repository at at http://reactjs.net/packages/. You can see its Nginx configuration at https://github.com/reactjs/React.NET/blob/master/site/nginx.conf

Licence
=======
(The MIT licence)

Copyright (C) 2014 Daniel Lo Nigro (Daniel15)

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies
of the Software, and to permit persons to whom the Software is furnished to do
so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
