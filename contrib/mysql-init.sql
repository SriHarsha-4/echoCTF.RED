DELIMITER ;;
IF (SELECT count(*) FROM information_schema.tables WHERE table_schema = 'echoCTF' AND table_name = 'devnull' LIMIT 1)>0 THEN
  DO echoCTF.init_mysql();
  DO memc_servers_behavior_set('MEMCACHED_BEHAVIOR_TCP_NODELAY','1');
  DO memc_servers_behavior_set('MEMCACHED_BEHAVIOR_NO_BLOCK','1');
END IF;;
DELIMITER ;
