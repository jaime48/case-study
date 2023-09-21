<?php

$finder = Symfony\Component\Finder\Finder::create()
    ->exclude('vendor')
    ->in(__DIR__)
    ->name('*.php')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return Symfony\Component\DependencyInjection\ContainerBuilder::buildDevContainer()
    ->register('fixer')
    ->addArgument($finder)
    ->addArgument([
        // Configure your rules here
        'psr4',
        '@PSR2',
    ])
    ->addArgument(true)
    ->addArgument(false)
    ->addArgument([
        'vendor',
        'bootstrap',
        'config',
        'database',
        'public',
        'resources',
        'routes',
        'storage',
        'tests',
    ])
    ->getDefinition()
    ->addMethodCall('setRules', [
        [
            '@PSR2' => true,
            'blank_line_after_opening_tag' => true,
            'braces' => true,
            'class_definition' => true,
            'elseif' => true,
            'function_declaration' => true,
            'indentation_type' => true,
            'line_ending' => true,
            'lowercase_keywords' => true,
            'method_argument_space' => [
                'on_multiline' => 'ignore',
            ],
            'no_blank_lines_after_class_opening' => true,
            'no_blank_lines_after_phpdoc' => true,
            'no_empty_phpdoc' => true,
            'no_extra_blank_lines' => true,
            'no_leading_import_slash' => true,
            'no_leading_namespace_whitespace' => true,
            'no_mixed_echo_print' => [
                'use' => 'echo',
            ],
            'no_trailing_comma_in_list_call' => true,
            'no_trailing_comma_in_singleline_array' => true,
            'no_trailing_whitespace' => true,
            'no_whitespace_in_blank_line' => true,
            'object_operator' => true,
            'php_unit_fqcn_annotation' => true,
            'phpdoc_align' => false,
            'phpdoc_indent' => true,
            'phpdoc_inline_tag' => true,
            'phpdoc_no_access' => true,
            'phpdoc_no_alias_tag' => [
                'type' => 'var',
            ],
            'phpdoc_no_empty_return' => true,
            'phpdoc_no_package' => true,
            'phpdoc_no_useless_inheritdoc' => true,
            'phpdoc_scalar' => true,
            'phpdoc_separation' => true,
            'phpdoc_single_line_var_spacing' => true,
            'phpdoc_summary' => false,
            'phpdoc_to_comment' => false,
            'phpdoc_trim' => true,
            'phpdoc_trim_consecutive_blank_line_separation' => true,
            'phpdoc_types' => true,
            'phpdoc_var_without_name' => true,
            'return_type_declaration' => true,
            'short_scalar_cast' => true,
            'single_blank_line_before_namespace' => true,
            'single_class_element_per_statement' => true,
            'single_import_per_statement' => true,
            'single_line_after_imports' => true,
            'single_quote' => true,
            'space_after_semicolon' => true,
            'standardize_not_equals' => true,
            'strict_param' => true,
            'ternary_operator_spaces' => true,
            'trim_array_spaces' => true,
            'unary_operator_spaces' => true,
            'visibility_required' => true,
        ],
    ])
    ->addMethodCall('setStopwatch', [null]);
