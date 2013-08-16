<?php

if( !function_exists( 'apc_clear_cache' ) ) {
    echo 'apc not available.';
}

echo '<a href="#" onclick="history.back(); return false;" >back...</a><br /> ';
if( isset( $_GET[ 'act' ] ) && $_GET[ 'act' ] == 'cache-clear' ) {
    apc_clear_cache( 'opcode' );
    apc_clear_cache( 'user' );
}
echo '<a href="cache.php?act=cache-clear">clear cache</a>';
$info = apc_cache_info( 'user' );
unset( $info[ 'slot_distribution' ] );
var_dump( $info );
