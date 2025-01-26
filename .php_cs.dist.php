<?php

$finder = PhpCsFixer\Finder::create()
        ->exclude('vendor')
        ->in([
            __DIR__ . '/app',
            __DIR__ . '/database/seeders'
        ]);

$config = new PhpCsFixer\Config();

return $config
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12' => true,
        '@PhpCsFixer:risky' => true,
        // PHPの開始タグの後に一行改行を入れる
        'blank_line_after_opening_tag' => true,
        // 開始タグの後ろに改行を入れて開始タグの行には記述がないようにする
        'linebreak_after_opening_tag' => true,
        // 配列ではarrayではなく[]にする
        'array_syntax' => [
            'syntax' => 'short'
        ],
        'phpdoc_types_order' => [
            'null_adjustment' => 'always_last',
            'sort_algorithm' => 'none',
        ],
        'no_superfluous_phpdoc_tags' => false,
        'global_namespace_import' => [
            'import_classes' => true,
            'import_constants' => false,
        ],
        'php_unit_test_case_static_method_calls' => [
            'call_type' => 'this'
        ],
        // 関数の返り値の型宣言にスペースが抜けていると補完する
        'function_typehint_space' => true,
        'phpdoc_align' => [
            'align' => 'left',
        ],
        // 結合演算子の前後に空ける空白の指定
        'concat_space' => [
            'spacing' => 'one'
        ],
        'not_operator_with_successor_space' => true,
        // セミコロンの前で複数行になるスペースを禁止します
        'multiline_whitespace_before_semicolons' => true,
        // クロージャーを1行で書くことを許容しない
        'braces' => [
            'allow_single_line_closure' => false,
        ],
        // =>の前後で複数行になるスペースを禁止します
        'no_multiline_whitespace_around_double_arrow' => true,
        // 使っていないuseを削除する
        'no_unused_imports' => true,
        // returnの前などに改行を入れる
        'blank_line_before_statement' => true,
        // メソッドやクラスの間に改行を入れる
        'class_attributes_separation' => true,
        // = や => などの演算子を揃える
        'binary_operator_spaces' => true,
        // countなどのnative functionの前にバックスラッシュをつけなくてよい
        'native_function_invocation' => false,
        // Anonymous classes should not be followed by parentheses.
        'new_with_braces' => [
            'anonymous_class' => false,
        ],
        // The position of the opening brace of anonymous classes body.
        'braces_position' => [
            'anonymous_classes_opening_brace' => 'next_line_unless_newline_at_signature_end',
        ],
    ])
    ->setFinder($finder);
