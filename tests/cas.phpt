--TEST--
Memcached fetch cas & set cas
--SKIPIF--
<?php if (!extension_loaded("memcached")) print "skip"; ?>
--FILE--
<?php
include dirname (__FILE__) . '/config.inc';
$m = memc_get_instance ();

$m->delete('cas_test');
$cas_token = 0;

$m->set('cas_test', 'hello');
$cas_token = $m->get('cas_test', null, Memcached::GET_EXTENDED)['cas'];

$v = $m->cas($cas_token, 'cas_test', 0);
echo "OK\n";
?>
--EXPECT--
OK