<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <!-- jQuery/jQueryUI (hosted) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.0/jquery-ui.min.js"></script>



    <!-- Index -->
    <style>
    #preview {
        border: solid thin silver;
        padding: 2em;
        margin: 0 10%;
        text-align: center;
        box-shadow: 0 0 2em silver;
    }

    .chapter {
        columns: 460px;
        column-gap: 4em;
        column-rule: thin solid silver;
        text-align: justify;
    }

    h1,
    h2 {
        background: black;
        color: white;
        padding: .2em .4em;
    }

    h1 {
        margin-top: 1em;
    }

    h2 {
        background: gray;
    }

    hr {
        border-top: double;
        margin: 2em 25%;
    }




    .clickable {
        cursor: pointer;
    }

    pre {
        tab-size: 4;
        overflow-x: auto;
        background-color: #eee;
    }
    </style>
    <script>
    $(function() {
        function tabsToSpaces(line, tabsize) {
            var out = '',
                tabsize = tabsize || 4,
                c;
            for (c in line) {
                var ch = line.charAt(c);
                if (ch === '\t') {
                    do {
                        out += ' ';
                    } while (out.length % tabsize);
                } else {
                    out += ch;
                }
            }
            return out;
        }

        function visualizeElement(element, type) {
            var code = $(element).html().split('\n'),
                tabsize = 4,
                minlength = 2E53,
                l;

            // Convert tabs to spaces
            for (l in code) {
                code[l] = tabsToSpaces(code[l], tabsize);
            }


            // determine minimum length
            var minlength = 2E53;
            var first = 2E53;
            var last = 0;
            for (l in code) {
                if (/\S/.test(code[l])) {
                    minlength = Math.min(minlength, /^\s*/.exec(code[l])[0].length);
                    first = Math.min(first, l);
                    last = Math.max(last, l);
                }
            }

            code = code.slice(first, last + 1);

            // strip tabs at start
            for (l in code) {
                code[l] = code[l].slice(minlength);
            }

            // recombine
            code = code.join('\n');

            var fragment = $('<pre class="prettyprint"><code/></pre>').text(code).insertAfter(element);
            $('<h3 class="clickable">' + type + '&hellip;</h3>').insertBefore(fragment).click(function() {
                fragment.slideToggle();
            });
        }

        // extract html fragments
        $('div.prettyprint, span.prettyprint').each(function() {
            visualizeElement(this, 'HTML');
        });

        // extract scripts
        $('script.prettyprint').each(function() {
            visualizeElement(this, 'Javascript');
        });


    });
    </script>
</head>

<body>
    <style>
    #preview {
        padding-bottom: 100px;
    }

    #preview-coverflow .cover {
        cursor: pointer;
        width: 320px;
        height: 240px;
        box-shadow: 0 0 4em 1em white;
    }
    </style>

    <div id="preview">
        <div id="preview-coverflow">
            <img class="cover" src="https://vanderlee.github.io/coverflow/demo/attic.jpg" />
            <img class="cover" src="https://vanderlee.github.io/coverflow/demo/aurora.jpg" />
            <img class="cover" src="https://vanderlee.github.io/coverflow/demo/barbecue.jpg" />
            <img class="cover" src="https://vanderlee.github.io/coverflow/demo/blackswan.jpg" />
            <img class="cover" src="https://vanderlee.github.io/coverflow/demo/chess.jpg" />
            <img class="cover" src="https://vanderlee.github.io/coverflow/demo/fire.jpg" />
            <img class="cover" src="https://vanderlee.github.io/coverflow/demo/keyboard.jpg" />
            <img class="cover" src="https://vanderlee.github.io/coverflow/demo/locomotive.jpg" />
            <img class="cover" src="https://vanderlee.github.io/coverflow/demo/diveevo.jpg" />
            <img class="cover" src="https://vanderlee.github.io/coverflow/demo/person.jpg" />
            <img class="cover" src="https://vanderlee.github.io/coverflow/demo/rose.jpg" />
            <img class="cover" src="https://vanderlee.github.io/coverflow/demo/seagull.jpg" />
            <img class="cover" src="https://vanderlee.github.io/coverflow/demo/solarpower.jpg" />
        </div>

        <script>
        $(function() {
            if ($.fn.reflect) {
                $('#preview-coverflow .cover').reflect(); // only possible in very specific situations
            }

            $('#preview-coverflow').coverflow({
                index: 6,
                density: 2,
                innerOffset: 50,
                innerScale: .7,
                animateStep: function(event, cover, offset, isVisible, isMiddle, sin, cos) {
                    if (isVisible) {
                        if (isMiddle) {
                            $(cover).css({
                                'filter': 'none',
                                '-webkit-filter': 'none'
                            });
                        } else {
                            var brightness = 1 + Math.abs(sin),
                                contrast = 1 - Math.abs(sin),
                                filter = 'contrast(' + contrast + ') brightness(' + brightness +
                                ')';
                            $(cover).css({
                                'filter': filter,
                                '-webkit-filter': filter
                            });
                        }
                    }
                }
            });
        });
        </script>

    </div>


    <!-- Plugin -->
    <script src="https://plataformadelmayor.org/coverflow/jquery.coverflow.js"></script>
    <!-- Optionals -->
    <script src="https://plataformadelmayor.org/coverflow/jquery.interpolate.min.js"></script>
    <script src="https://plataformadelmayor.org/coverflow/jquery.touchSwipe.min.js"></script>
    <script src="https://plataformadelmayor.org/coverflow/reflection.js"></script>

</body>

</html>