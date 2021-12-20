<?php

$config = new PhpCsFixer\Config();

return $config
    ->setRiskyAllowed(true)
    ->setRules(
        [
            '@PSR12' => true,
            'psr_autoloading' => true,
            'align_multiline_comment' => true,
            'array_syntax' => [
                'syntax' => 'short',
            ],
            'binary_operator_spaces' => true,
            'blank_line_before_statement' => [
                'statements' => [
                    'return',
                    'throw',
                ],
            ],
            'cast_spaces' => [
                'space' => 'single',
            ],
            'concat_space' => [
                'spacing' => 'one',
            ],
            'method_chaining_indentation' => true,
            'function_typehint_space' => true,
            'multiline_comment_opening_closing' => true,
            'general_phpdoc_annotation_remove' => [
                'annotations' => [
                    'author',
                    'package',
                    'subpackage',
                ],
            ],
            'include' => true,
            'linebreak_after_opening_tag' => true,
            'mb_str_functions' => true,
            'magic_method_casing' => true,
            'magic_constant_casing' => true,
            'class_attributes_separation' => [
                'elements' => [
                    'const' => 'one',
                    'method' => 'one',
                    'property' => 'one',
                ],
            ],
            'modernize_types_casting' => true,
            'native_function_casing' => true,
            'no_blank_lines_after_phpdoc' => true,
            'no_empty_comment' => true,
            'no_empty_phpdoc' => true,
            'no_empty_statement' => true,
            'no_extra_blank_lines' => true,
            'no_mixed_echo_print' => [
                'use' => 'echo',
            ],
            'multiline_whitespace_before_semicolons' => [
                'strategy' => 'no_multi_line',
            ],
            'no_php4_constructor' => true,
            'no_short_bool_cast' => true,
            'no_trailing_comma_in_singleline_array' => true,
            'no_unused_imports' => true,
            'no_whitespace_before_comma_in_array' => true,
            'object_operator_without_whitespace' => true,
            'phpdoc_add_missing_param_annotation' => [
                'only_untyped' => false,
            ],
            'phpdoc_indent' => true,
            'general_phpdoc_tag_rename' => true,
            'phpdoc_no_alias_tag' => [
                'replacements' => [
                    'type' => 'var',
                    'link' => 'see',
                ],
            ],
            'phpdoc_no_empty_return' => true,
            'phpdoc_no_package' => true,
            'phpdoc_no_useless_inheritdoc' => true,
            'phpdoc_order' => true,
            'phpdoc_scalar' => true,
            'phpdoc_separation' => true,
            'phpdoc_trim' => true,
            'phpdoc_types' => true,
            'phpdoc_var_without_name' => true,
            'random_api_migration' => true,
            'single_line_comment_style' => [
                'comment_types' => [
                    'asterisk',
                    'hash',
                ],
            ],
            'single_quote' => false,
            'space_after_semicolon' => true,
            'standardize_not_equals' => true,
            'ternary_to_null_coalescing' => true,
            'trailing_comma_in_multiline' => [
                'elements' => [
                    'arrays',
                ],
            ],
            'trim_array_spaces' => true,
            'unary_operator_spaces' => true,
            'yoda_style' => false,
            'phpdoc_summary' => false,
        ]
    );
