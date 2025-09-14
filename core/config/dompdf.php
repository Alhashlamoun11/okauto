<?php

return [

    'show_warnings' => false,
    'orientation' => 'portrait',
    'defines' => [
        "font_dir" => storage_path('fonts/'),
        "font_cache" => storage_path('fonts/'),
        "temp_dir" => sys_get_temp_dir(),
        "chroot" => base_path(),
        "log_output_file" => storage_path('logs/dompdf.html'),
        "enable_remote" => true,
        "default_media_type" => "screen",
        "default_paper_size" => "a4",
        "default_font" => "dejavusans",
        "dpi" => 96,
        "is_php_enabled" => false,
        "is_remote_enabled" => true,
        "is_html5_parser_enabled" => true,
        "is_font_subsetting_enabled" => false,
        "debug_png" => false,
        "debug_keep_temp" => false,
        "debug_css" => false,
        "debug_layout" => false,
        "debug_layout_lines" => true,
        "debug_layout_blocks" => true,
        "debug_layout_inline" => true,
        "debug_layout_padding_box" => true,
    ]
];
