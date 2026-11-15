@php
    $show = fn ($v) => var_export($v instanceof \Illuminate\Support\Stringable ? (string) $v : $v, true);
@endphp

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strictテスト</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            padding: 32px 16px;
            background: #f4f4f5;
            color: #1f2430;
            font-family: "Hiragino Kaku Gothic ProN", "Hiragino Sans", "Noto Sans JP", sans-serif;
        }
        h2 {
            max-width: 720px;
            margin: 0 auto 16px;
            font-size: 20px;
        }
        section {
            max-width: 720px;
            margin: 0 auto 16px;
            padding: 20px 24px;
            background: #fff;
            border: 1px solid #e2e2e6;
            border-radius: 8px;
        }
        section p { margin: 0 0 16px; }
        .input-value {
            font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
            font-weight: 700;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            table-layout: fixed;
        }
        th, td {
            border: 1px solid #c9c9cf;
            padding: 8px 12px;
            text-align: left;
        }
        thead th {
            background: #ececf1;
            text-align: center;
        }
        tbody th {
            background: #f7f7fa;
            font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
            white-space: nowrap;
        }
        td {
            font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
        }
        td.strict {
            background: #fff6da;
            font-weight: 700;
        }
        td.alert {
            background: #fde8e8;
            color: #b91c1c;
            font-weight: 700;
        }
        form div { margin-bottom: 12px; }
        label {
            display: block;
            margin-bottom: 4px;
            font-size: 13px;
            font-weight: 700;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #b9b9c0;
            border-radius: 4px;
            font-size: 14px;
        }
        input[type="submit"] {
            padding: 8px 20px;
            border: none;
            border-radius: 4px;
            background: #1f2430;
            color: #fff;
            font-size: 14px;
            cursor: pointer;
        }
        input[type="submit"]:hover { background: #3a4152; }
    </style>
</head>
<body>
    <h2>Strictテスト</h2>

    <section>
        <form action="/" method="get">
            <div>
                <label for="value">value</label>
                <input type="text" name="value" id="value" value="{{ $value }}">
            </div>
            <input type="submit" value="テストする">
        </form>
    </section>

    @if ($hasValue)
        <section>
            <p>入力された値は「<span class="input-value">{{ $value }}</span>」でした。</p>

            <table>
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Default</th>
                        <th>Normal</th>
                        <th>Strict</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($types as $type)
                        @php
                            $isDiff = $show($normal[$type]) !== $show($strict[$type]);
                            $normalAlert = $isDiff && $show($normal[$type]) !== $show($default[$type]);
                            $strictAlert = $isDiff && $show($strict[$type]) !== $show($default[$type]);
                        @endphp
                        <tr>
                            <th>{{ $type }}</th>
                            <td>{{ $show($default[$type]) }}</td>
                            <td @class(['alert' => $normalAlert])>{{ $show($normal[$type]) }}</td>
                            <td @class(['strict', 'alert' => $strictAlert])>{{ $show($strict[$type]) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    @endif
</body>
</html>
