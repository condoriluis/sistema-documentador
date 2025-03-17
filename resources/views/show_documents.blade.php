<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>

        @php
        $firstDocument = true;
        @endphp
        @foreach($document as $doc)
        @if($firstDocument)

        {{ $doc['name'] }} - Documentación

        @php
        $firstDocument = false;
        @endphp
        @break
        @endif
        @endforeach

    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-okaidia.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/toolbar/prism-toolbar.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #6a7984;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background: #e0e0e0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1,
        h2,
        h3 {
            color: #2c3e50;
        }

        h1 {
            text-align: center;
            margin-bottom: 10px;
            margin-top: 0;
        }

        h2 {
            margin-top: 30px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 5px;
        }

        code {
            background-color: #ecf0f1;

            border-radius: 3px;
            font-family: 'Courier New', Courier, monospace;
            color: #e74c3c;
        }

        div.toolbar-item button {
            cursor: pointer !important;
        }

        a {
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .note {
            background-color: #f9f9f9;
            border-left: 4px solid #3498db;
            padding: 10px;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="container">

        @php
        $firstDocument = true;
        @endphp

        @foreach($document as $doc)
        @if ($firstDocument)

        <h1>{{ $doc['name'] }}</h1>
        @php
        $firstDocument = false;
        @endphp
        @endif

        <h2>{{ $doc['title'] }}</h2>
        <p>{{ $doc['description'] }}</p>
        <pre class="line-numbers"><code class="language-batch">{{ $doc['code'] }}</code></pre>

        @if(isset($doc['note']) && $doc['note'] != null)
        <div class="note">
            <p><strong>Nota:</strong> {{ $doc['note'] }}</p>
        </div>

        @endif
        @endforeach

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-batch.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/toolbar/prism-toolbar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js"></script>

</body>

</html>