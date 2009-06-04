<?php include '../include/header.html'; ?>

<center>
<table width="680"><tr> <td><img src="index.gif"></td></tr></table>
</center>

<?php include '../include/menu.php'; ?>

<h2>Real-world configuration examples</h2>

Here's some real-world configuration examples for monit. It can be
helpful to look at the examples given here to see how a service is
running, where it put its pidfile, how to call the start and stop
methods for a service, etc.

<p>You are welcome to cut & paste configuration into your own
<code>monitrc</code> control file. <b>NB!</b> please check and edit as
needed, some ip-addresses and paths mentioned here may or will differ
from your system.

<p>You may also want to checkout Christian Hopp's <a
href="monitrc_debian_current.tar.gz">configuration
example</a>. He demonstrate how you can setup a clean and structured
configuration utilizing the monit include statement (which he was
responsible for). Each check for a particular service is written
in it's own file and included in the top-level monit control
file. Many of the service files are also well worth studying in their
own rights. Although this example is for a Linux Debian distribution
it is general enough to be of interest for any platform.


<br><p><br>

<ul>
  <li> System Services
     <ul>
        <LI><A HREF="#cron">Cron (program timer)</A></LI>
        <LI><A HREF="#gdm">Gdm (gnome desktop manager)</A></LI>
        <LI><A HREF="#inetd">Inetd (internet service manager)</A></LI>
        <LI><A HREF="#syslogd">Syslogd (system logfile daemon)</A></LI>
        <LI><A HREF="#xfs">Xfs (X font server)</A></LI>
        <LI><A HREF="#ypbind">YPBind (Yellow page bind daemon)</A></LI>
        <LI><A HREF="#netsnmp">Net-SNMP (SNMP agent)</A></LI>
        <LI><A HREF="#ntp">NTP (time server)</A></LI>
        <LI><A HREF="#nscd">Nscd (name service caching daemon)</A></LI>
     </ul>
  </li>
  <li> Name Services
     <ul>
        <LI><A HREF="#nscd">Bind (chrooted)</A></LI>
     </ul>
  </li>
  <li> FTP Services
     <ul>
        <LI><A HREF="#proftp">Proftpd</A></LI>
     </ul>
  </li>
  <li> Login Services
     <ul>
        <LI><A HREF="#ssh">SSHD</A></LI>
     </ul>
  </li>
  <li> WWW Services
     <ul>
        <LI><A HREF="#apache">Apache (web server)</A></LI>
        <LI><A HREF="#zope">Zope (appication server)</A></LI>
        <LI><A HREF="#squid">Squid (http/ftp proxy)</A></LI>
        <LI><A HREF="#privoxy">Privoxy (spamfilter proxy)</A></LI>
     </ul>
  </li>
  <li> Mail Services
     <ul>
        <LI><A HREF="#postfix">Postfix (mail server)</A></LI>
        <LI><A HREF="#exim">Exim (mail server)</A></LI>
        <LI><A HREF="#sendmail">sendmail (mail server)</A></LI>
        <LI><A HREF="#qpopper">Qpopper (pop3 server)</A></LI>
        <LI><A HREF="#spamd">Spamassassin daemon (spam scan daemon)</A></LI>
        <LI><A HREF="#amavis">Amavis-new (mail virus scanner)</A></LI>
        <LI><A HREF="#policyd">Policyd (Postfix access policy delegation daemon)</A></LI>
     </ul>
  </li>
  <li> Virus Scanner
     <ul>
        <LI><A HREF="#sophie">Sophie (virus scan daemon)</A></LI>
        <LI><A HREF="#trophie">Trophie (virus scan daemon)</A></LI>
        <LI><A HREF="#clamavd">Clamavd (virus scan daemon)</A></LI>
     </ul>
  </li>
  <li> Printing Services
     <ul>
        <LI><A HREF="#lprng">LPRng (printer daemon)</A></LI>
     </ul>
  </li>
  <li> Database Services
     <ul>
        <LI><A HREF="#mysqld">MySQL Server</A></LI>
        <LI><A HREF="#openldap">OpenLDAP Server</A></LI>
        <LI><A HREF="#postgresql">PostgreSQL Server</A></LI>
     </ul>
  </li>
  <li> File Services
     <ul>
        <LI><A HREF="#samba">Samba (windows file/domain server)</A></LI>
     </ul>
  </li>
  <li> Sun ONE Services
     <ul>
	<LI><A HREF="#iplanetdir">iPlanetDirectoryServer (Sun ONE)</A></LI>
	<LI><A HREF="#iplanetmsg">iPlanetMessagingServer processes (Sun ONE)</A></LI>
	<LI><A HREF="#iplanetcal">iPlanetCalendarServer processes (Sun ONE)</A></LI>
     </ul>
  </li>
  <li> Misc Services
     <ul>
        <LI><A HREF="#apcupsd">apcupsd (APC ups daemon)</A></LI>
        <LI><A HREF="#webmin">Webmin (remote admin service)</A></LI>
        <LI><A HREF="#stunnel">STunnel (SSL tunnel)</A></LI>
     </ul>
  </li>
  <li> Misc Usage
     <ul>
        <LI><A HREF="#coresol">Watch and analyze crashdumps (Solaris)</A></LI>
        <LI><A HREF="#corelin">Watch and analyze crashdumps (Linux)</A></LI>
        <LI><A HREF="#tcpdump1">Start and stop tcpdump based on condition</A></LI>
        <LI><A HREF="#tcpdump2">Rotate tcpdump until condition occures</A></LI>
        <LI><A HREF="#mysqldproc">MySQL event driven process list</A></LI>
     </ul>
  </li>
</ul>


<h2>System Services</h2>
<h3><a name="cron">Cron (program timer)</a></h3>
<p>
When used with <b>Solaris</b> the init.d script needs a modification.
Add the following line after start of cron according to the 
<a href="http://www.tildeslash.com/monit/doc/faq.php">Monit FAQ</a>:
</p>
<pre>
         /usr/bin/pgrep -x -u 0 -P 1 cron > /var/run/cron.pid 
</pre>
<pre>
 check process cron with pidfile /var/run/cron.pid
   group system
   start program = "/etc/init.d/cron start"
   stop  program = "/etc/init.d/cron stop"
   if 5 restarts within 5 cycles then timeout
   depends on cron_rc

 check file cron_rc with path /etc/init.d/cron
   group system
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor
</pre>

<h3><a name="gdm">Gdm (gnome desktop manager)</a></h3>
<pre>
 check process gdm with pidfile /var/run/gdm.pid
   start program = "/etc/init.d/gdm start"
   stop program = "/etc/init.d/gdm stop"
   if 5 restarts within 5 cycles then timeout
</pre>

<h3><a name="inetd">Inetd (internet service manager)</a></h3>
<pre>
 check process inetd with pidfile /var/run/inetd.pid
   start program = "/etc/init.d/inetd start"
   stop program = "/etc/init.d/inetd stop"
   if failed host 192.168.1.1 port 25 protocol smtp then restart  # e.g. exim 
   if failed host 192.168.1.1 port 515 then restart               # e.g. cups-lpd
   if failed host 192.168.1.1 port 113 then restart               # e.g. ident
   if 5 restarts within 5 cycles then timeout
</pre>

<h3><a name="syslogd">Syslogd (system logfile daemon)</a></h3>
<pre>
 check process syslogd with pidfile /var/run/syslogd.pid
   start program = "/etc/init.d/sysklogd start"
   stop program = "/etc/init.d/sysklogd stop"
   if 5 restarts within 5 cycles then timeout

 check file syslogd_file with path /var/log/syslog
   if timestamp > 65 minutes then alert # Have you seen "-- MARK --"?
</pre>

<h3><a name="xfs">Xfs (X font server)</a></h3>
<pre>
 check process xfs with pidfile /var/run/xfs.pid
   start program = "/etc/init.d/xfs start"
   stop program = "/etc/init.d/xfs stop"
   if 5 restarts within 5 cycles then timeout
</pre>

<h3><a name="ypbind">YPBind (Yellow page bind daemon)</a></h3>
<pre>
 check process ypbind with pidfile /var/run/ypbind.pid
   start program = "/etc/init.d/nis start"
   stop program = "/etc/init.d/nis stop"
   if 5 restarts within 5 cycles then timeout
</pre>

<h3><a name="netsnmp">Net-SNMP (SNMP agent)</a></h3>
<pre>
 check process snmpd with pidfile /var/run/snmpd
   start program = "/etc/init.d/snmpd start"
   stop program = "/etc/init.d/snmpd stop"
   if failed host 192.168.1.1 port 161 type udp then restart
   if failed host 192.168.1.1 port 199 type tcp then restart
   if 5 restarts within 5 cycles then timeout
</pre>

<h3><a name="ntp">NTP (time server)</a></h3>
<pre>
 check process ntpd with pidfile /var/run/ntpd.pid
   start program = "/etc/init.d/ntpd start"
   stop  program = "/etc/init.d/ntpd stop"
   if failed host 127.0.0.1 port 123 type udp then alert
   if 5 restarts within 5 cycles then timeout
</pre>

<h3><a name="nscd">Nscd (name service caching daemon)</a></h3>
<pre>
 check process nscd with pidfile /var/run/nscd/nscd.pid
   start program = "/etc/init.d/nscd start"
   stop  program = "/etc/init.d/nscd stop"
   if 5 restarts within 5 cycles then timeout
</pre>

<h2>Name Services</h2>
<h3><a name="bind">Bind (chrooted)</a></h3>
<pre>
 check process named with pidfile /var/named/chroot/var/run/named/named.pid
   start program = "/etc/init.d/named start"
   stop program = "/etc/init.d/named stop"
   if failed host 127.0.0.1 port 53 type tcp protocol dns then alert
   if failed host 127.0.0.1 port 53 type udp protocol dns then alert
   if 5 restarts within 5 cycles then timeout
</pre>

<h2>FTP Services</h2>
<h3><a name="proftp">Proftpd</a></h3>
<pre>
 check process proftpd with pidfile /var/run/proftpd.pid
   start program = "/etc/init.d/proftpd start"
   stop program  = "/etc/init.d/proftpd stop"
   if failed port 21 protocol ftp then restart
   if 5 restarts within 5 cycles then timeout
</pre>

<h2>Login Services</h2>
<h3><a name="ssh">SSHD</a></h3>
<pre>
 check process sshd with pidfile /var/run/sshd.pid
   start program  "/etc/init.d/sshd start"
   stop program  "/etc/init.d/sshd stop"
   if failed port 22 protocol ssh then restart
   if 5 restarts within 5 cycles then timeout
</pre>

<h2>WWW Services</h2>
<h3><a name="apache">Apache (web server)</a></h3>
<p>
  <b>Hint:</b> It is recommended to use a "token" file (an empty file)
  for monit to request. That way, it is easy to filter out all the
  requests made by monit in the httpd access log file. Here's a trick
  shared by Marco Ermini, place the following in httpd.conf to stop
  apache from loggin any requests done by monit:
</p>
<pre>
  SetEnvIf        Request_URI "^\/monit\/token$" dontlog
  CustomLog       logs/access.log common env=!dontlog
</pre>

<p>
  In some cases init scripts for apache and apache-ssl are separated, e.g. Debian Linux.
</p>
<pre>
 check process apache with pidfile /opt/apache_misc/logs/httpd.pid
   group www
   start program = "/etc/init.d/apache start"
   stop  program = "/etc/init.d/apache stop"
   if failed host 192.168.1.1 port 80 
        protocol HTTP request /monit/token then restart
   if failed host 192.168.1.1 port 443 type TCPSSL 
        certmd5 12-34-56-78-90-AB-CD-EF-12-34-56-78-90-AB-CD-EF
	protocol HTTP request /monit/token  then restart
   if 5 restarts within 5 cycles then timeout
   depends on apache_bin
   depends on apache_rc

 check file apache_bin with path /opt/apache/bin/httpd
   group www
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor

 check file apache_rc with path /etc/init.d/apache
   group www
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor
</pre>

<h3><a name="zope">Zope (application server)</a></h3>
<pre>
 check process zope with pidfile /opt/Zope/var/zProcessManager.pid
   start program = "/etc/init.d/zope start"
   stop  program = "/etc/init.d/zope stop"
   group www
   if failed host 192.168.1.1 port 8080 protocol HTTP then restart
   if 5 restarts within 5 cycles then timeout
   every 5
</pre>

<h3><a name="squid">Squid (http/ftp proxy)</a></h3>
<pre>
 check process squid with pidfile /opt/squid/logs/squid.pid
   group www
   start program = "/etc/init.d/squid start"
   stop  program = "/etc/init.d/squid stop"
   if failed host 192.168.1.1 port 3128  then restart
   if 5 restarts within 5 cycles then timeout
   depends on squid_bin
   depends on squid_rc

 check file squid_bin with path /opt/squid/bin/squid
   group www
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor

 check file squid_rc with path /etc/init.d/squid
   group www
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor
</pre>

<h3><a name="privoxy">Privoxy (spamfilter proxy)</a></h3>
<pre>
 check process privoxy with pidfile /opt/privoxy/var/privoxy.pid
   group www
   start program = "/etc/init.d/privoxy start"
   stop  program = "/etc/init.d/privoxy stop"
   if 5 restarts within 5 cycles then timeout
   if failed host 192.168.1.1 port 8118  then restart
   depends on privoxy_bin
   depends on privoxy_rc

 check file privoxy_bin with path /opt/privoxy/sbin/privoxy
   group www
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor

 check file privoxy_rc with path /etc/init.d/privoxy
   group www
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor
</pre>

<h2>Mail Services</h2>

<h3><a name="postfix">Postfix (mail server)</a></h3>
<pre>
 check process postfix with pidfile /var/spool/postfix/pid/master.pid
   group mail
   start program = "/etc/init.d/postfix start"
   stop  program = "/etc/init.d/postfix stop"
   if failed port 25 protocol smtp then restart
   if 5 restarts within 5 cycles then timeout
   depends on postfix_rc

 check file postfix_rc with path /etc/init.d/postfix
   group mail
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor
</pre>

<h3><a name="exim">Exim (mail server)</a></h3>
<pre>
 check process exim with pidfile /var/run/exim.pid
   group mail
   start program = "/etc/init.d/exim start"
   stop  program = "/etc/init.d/exim stop"
   if failed port 25 protocol smtp then restart
   if 5 restarts within 5 cycles then timeout
   depends on exim_bin
   depends on exim_rc

 check file exim_bin with path /usr/sbin/exim
   group mail
   if failed checksum then unmonitor
   if failed permission 4755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor

 check file exim_rc with path /etc/init.d/exim
   group mail
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor 
<pre>

<h3><a name="sendmail">Sendmail (mail server)</a></h3>
<pre>
 check process sendmail with pidfile /var/run/sendmail.pid
   group mail
   start program = "/etc/init.d/sendmail start"
   stop  program = "/etc/init.d/sendmail stop"
   if failed port 25 protocol smtp then restart
   if 5 restarts within 5 cycles then timeout
   depends on sendmail_bin
   depends on sendmail_rc

 check file sendmail_bin with path /usr/lib/sendmail
   group mail
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor

 check file sendmail_rc with path /etc/init.d/sendmail
   group mail
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor
</pre>

<h3><a name="qpopper">Qpopper (pop3 server)</a></h3>
<pre>
 check process qpopper with pidfile /var/run/popper.pid
   group mail
   start program = "/etc/init.d/qpopper start"
   stop  program = "/etc/init.d/qpopper stop"
   if 5 restarts within 5 cycles then timeout
   if failed port 110 type TCP protocol POP then restart
   depends on qpopper_bin
   depends on qpopper_rc

 check file qpopper_bin with path /opt/sbin/popper
   group mail
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor

 check file qpopper_rc with path /etc/init.d/qpopper
   group mail
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor
</pre>

<h3><a name="spamd">Spamassassin daemon (spam scan daemon)</a></h3>
<pre>
 check process spamd with pidfile /var/run/spamd.pid
   group mail
   start program = "/etc/init.d/spamd start"
   stop  program = "/etc/init.d/spamd stop"
   if 5 restarts within 5 cycles then timeout
   if cpu usage > 99% for 5 cycles then alert
   if mem usage > 99% for 5 cycles then alert
   depends on spamd_bin
   depends on spamd_rc

 check file spamd_bin with path /usr/local/bin/spamd
   group mail
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor

 check file spamd_rc with path /etc/init.d/spamd
   group mail
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor
</pre>

<h3><a name="amavis">Amavis-new (mail virus scanner)</a></h3>
<pre>
 check process amavisd with pidfile /opt/virus/amavis-new/var/run/amavisd.pid
   group mail
   start program = "/etc/init.d/amavis-new start"
   stop  program = "/etc/init.d/amavis-new stop"
   if failed port 10024 protocol smtp then restart
   if 5 restarts within 5 cycles then timeout
   depends on amavisd_bin
   depends on amavisd_rc

 check file amavisd_bin with path /opt/virus/amavis-new/bin/amavisd
   group mail
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor

 check file amavisd_rc with path /etc/init.d/amavis-new
   group mail
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor
</pre>

<h3><a name="policyd">Policyd (Postfix policy delegation daemon)</a></h3>
<pre>
 check process policyd with pidfile /var/run/policyd.pid
   group mail
   start program = "/etc/init.d/policyd start"
   stop  program = "/etc/init.d/policyd stop"
   if failed port 10031 protocol postfix-policy then restart
   if 5 restarts within 5 cycles then timeout
   depends on policyd_bin
   depends on policyd_rc
   depends on cleanup_bin

 check file policyd_bin with path /usr/local/policyd/policyd
   group mail
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor

 check file policyd_rc with path /etc/init.d/policyd
   group mail
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor

 check file cleanup_bin with path /usr/local/policyd/cleanup
   group mail
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor
</pre>

<h2>Virus Scanner</h2>
<h3><a name="sophie">Sophie (virus scan daemon)</a></h3>
<pre>
 check process sophie with pidfile /var/run/sophie.pid
   group virus
   start program = "/etc/init.d/sophie start"
   stop  program = "/etc/init.d/sophie stop"
   if failed unixsocket /var/run/sophie then restart
   if 5 restarts within 5 cycles then timeout
<h2>Virus Scanner</h2>
<h3><a name="sophie">Sophie (virus scan daemon)</a></h3>
<pre>
 check process sophie with pidfile /var/run/sophie.pid
   group virus
   start program = "/etc/init.d/sophie start"
   stop  program = "/etc/init.d/sophie stop"
   if failed unixsocket /var/run/sophie then restart
   if 5 restarts within 5 cycles then timeout
   depends on sophie_bin
   depends on sophie_rc

 check file sophie_bin with path /opt/virus/sophie/sophie
   group virus
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor

 check file sophie_rc with path /etc/init.d/sophie
   group virus
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor
</pre>


<h3><a name="trophie">Trophie (virus scan daemon)</a></h3>
<pre>
 check process trophie with pidfile /var/run/trophie.pid
   group virus
   start program = "/etc/init.d/trophie start"
   stop  program = "/etc/init.d/trophie stop"
   if failed unixsocket /var/run/trophie then restart
   if 5 restarts within 5 cycles then timeout
   depends on trophie_bin
   depends on trophie_rc

 check file trophie_bin with path /opt/virus/trophie/trophie
   group virus
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor

 check file trophie_rc with path /etc/init.d/trophie
   group virus
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor
</pre>

<h3><a name="clamavd">Clamav (virus scan daemon)</a></h3>
<pre>
 check process clamavd with pidfile /var/run/clamd.pid
   group virus
   start program = "/etc/init.d/clamavd start"
   stop  program = "/etc/init.d/clamavd stop"
   if failed unixsocket /var/run/clamd then restart
   if 5 restarts within 5 cycles then timeout
   depends on clamavd_bin
   depends on clamavd_rc

 check file clamavd_bin with path /opt/virus/clamavd/clamavd
   group virus
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor

 check file clamavd_rc with path /etc/init.d/clamavd
   group virus
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor
</pre>

<h2>Database Services</h2>
<h3><a name="mysqld">MySQL Server</a></h3>
<p>
  The name of the <tt>pidfile</tt> consists usually of the fully
  quallified domainname and <tt>pidfile</tt> as extension.
</p>
<pre>
check process mysql with pidfile /opt/mysql/data/myserver.mydomain.pid
   group database
   start program = "/etc/init.d/mysql start"
   stop program = "/etc/init.d/mysql stop"
   if failed host 192.168.1.1 port 3306 protocol mysql then restart
   if 5 restarts within 5 cycles then timeout
   depends on mysql_bin
   depends on mysql_rc

 check file mysql_bin with path /opt/mysql/bin/mysqld
   group database
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor

 check file mysql_rc with path /etc/init.d/mysql
   group database
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor
</pre>

<h3><a name="openldap">OpenLDAP slapd (Debian package)</a></h3>
<pre>
check process slapd with pidfile /var/run/slapd.pid
   group database
   start program = "/etc/init.d/slapd start"
   stop program = "/etc/init.d/slapd stop"
   if failed host 192.168.1.1 port 389 protocol ldap3 then restart
   if 5 restarts within 5 cycles then timeout
   depends on slapd_bin
   depends on slapd_rc

 check file slapd_bin with path /usr/sbin/slapd
   group database
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor

 check file slapd_rc with path /etc/init.d/slapd
   group database
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor
</pre>


<h3><a name="postgresql">PostgreSQL</a></h3>
<p>
  Generally choosing either the socket <em>or</em> a TCP/IP connect is sufficient.
</p>
<pre>
check process postgres with pidfile /var/postgres/postmaster.pid
   group database
   start program = "/etc/init.d/postgresql start"
   stop  program = "/etc/init.d/postgresql stop"
   if failed unixsocket /var/run/postgresql/.s.PGSQL.5432 protocol pgsql then restart
   if failed host       192.168.1.1 port 5432             protocol pgsql then restart
   if 5 restarts within 5 cycles then timeout
</pre>


<h2>File Services</h2>
<h3><a name="samba">Samba (windows file/domain server)</a></h3>
<p>
   <b>Hint:</b> For enhanced controllability of the service it is
   handy to split up the samba init file into two pieces, one for smbd
   (the file service) and one for nmbd (the name service).
</p>
<pre>
 check process smbd with pidfile /opt/samba2.2/var/locks/smbd.pid
   group samba
   start program = "/etc/init.d/smbd start"
   stop  program = "/etc/init.d/smbd stop"
   if failed host 192.168.1.1 port 139 type TCP  then restart
   if 5 restarts within 5 cycles then timeout
   depends on smbd_bin

 check file smbd_bin with path /opt/samba2.2/sbin/smbd
   group samba
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor
</pre>

<pre>
 check process nmbd with pidfile /opt/samba2.2/var/locks/nmbd.pid
   group samba
   start program = "/etc/init.d/nmbd start"
   stop  program = "/etc/init.d/nmbd stop"
   if failed host 192.168.1.1 port 138 type UDP  then restart
   if failed host 192.168.1.1 port 137 type UDP  then restart
   if 5 restarts within 5 cycles then timeout
   depends on nmbd_bin

 check file nmbd_bin with path /opt/samba2.2/sbin/nmbd
   group samba
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor
</pre>

<h2>Printing  Services</h2>
<h3><a name="lprng">LPRng (printer daemon)</a></h3>
<pre>
 check process lprng with pidfile /var/run/lpd.515
   group printer
   start program = "/etc/init.d/lprng start"
   stop  program = "/etc/init.d/lprng stop"
   if failed host 192.168.1.1 port 515 type TCP  then restart
   if 5 restarts within 5 cycles then timeout
   depends on lprng_bin
   depends on lprng_rc

 check file lprng_bin with path /opt/lprng/sbin/lpd
   group printer
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor

 check file lprng_rc with path /etc/init.d/lprng
   group printer
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor
</pre>

<h2>Sun ONE Services</h2>
<h3><a name="iplanetdir">iPlanetDirectoryServer slapd</a></h3>
<pre>
 check process ldap-master
  with pidfile /usr/iplanet/ldapmaster/slapd-master-1/logs/pid
   start program  "/usr/iplanet/ldapmaster/slapd-master-1/start-slapd"
   stop program  "/usr/iplanet/ldapmaster/slapd-master-1/stop-slapd"
   if 5 restarts within 5 cycles then timeout
   if failed host 192.168.1.1 port 389 protocol ldap3 then restart
</pre>

<h3><a name="iplanetmsg">iPlanetMessagingServer MTA dispatcher</a></h3>
<pre>
 check process mta-dispatcher 
  with pidfile /usr/iplanet/msg-ims-1/config/pidfile.imta_dispatch
   start program  "/usr/iplanet/msg-ims-1/imsimta start dispatcher"
   stop program  "/usr/iplanet/msg-ims-1/imsimta stop dispatcher"
   group messaging
   if 5 restarts within 5 cycles then timeout
   if failed host 192.168.1.1 port 25 protocol smtp then restart
</pre>

<h3> iPlanetMessagingServer MTA job controler</h3>
<pre>
 check process mta-job_controller 
  with pidfile /usr/iplanet/msg-ims-1/config/pidfile.imta_jbc
   start program  "/usr/iplanet/msg-ims-1/imsimta start job_controller"
   stop program  "/usr/iplanet/msg-ims-1/imsimta stop job_controller"
   group messaging
   if 5 restarts within 5 cycles then timeout
   if failed host 192.168.1.1 port 28442 then restart
</pre>

<h3> iPlanetMessagingServer stored</h3>
<pre>
 check process store with pidfile /usr/iplanet/msg-ims-1/config/pidfile.store
   start program  "/usr/iplanet/msg-ims-1/start-msg store"
   stop program  "/usr/iplanet/msg-ims-1/stop-msg store"
   if 5 restarts within 5 cycles then timeout
   group messaging

 check file stored.ckp with path /usr/iplanet/msg-ims-1/config/stored.ckp
   if timestamp > 10 minutes then alert
   group messaging

 check file stored.lcu with path /usr/iplanet/msg-ims-1/config/stored.lcu
   if timestamp > 15 minutes then alert
   group messaging

 check file stored.per with path /usr/iplanet/msg-ims-1/config/stored.per
   if timestamp > 70 minutes then alert
   group messaging
</pre>

<h3> iPlanetMessagingServer mshttpd</h3>
<pre>
 check process webmail with pidfile /usr/iplanet/msg-ims-1/config/pidfile.http
   start program  "/usr/iplanet/msg-ims-1/start-msg http"
   stop program  "/usr/iplanet/msg-ims-1/stop-msg http"
   group messaging
   if 5 restarts within 5 cycles then timeout
   if failed host 192.168.1.1 port 80 protocol http then restart
</pre>

<h3> iPlanetMessagingServer popd</h3>
<pre>
 check process pop3 with pidfile /usr/iplanet/msg-ims-1/config/pidfile.pop
   start program  "/usr/iplanet/msg-ims-1/start-msg pop"
   stop program  "/usr/iplanet/msg-ims-1/stop-msg pop"
   group messaging
   if 5 restarts within 5 cycles then timeout
   if failed host 192.168.1.1 port 110 protocol pop then restart
</pre>

<h3> iPlanetMessagingServer imapd</h3>
<pre>
 check process imap4 with pidfile /usr/iplanet/msg-ims-1/config/pidfile.imap
   start program  "/usr/iplanet/msg-ims-1/start-msg imap"
   stop program  "/usr/iplanet/msg-ims-1/stop-msg imap"
   group messaging
   if 5 restarts within 5 cycles then timeout
   if failed host 192.168.1.1 port 143 protocol imap then restart
</pre>

<h3> iPlanetMessagingServer madmand (SNMP subagent)</h3>
<pre>
 check process snmp-subagent with pidfile /usr/iplanet/msg-ims-1/config/pidfile.snmp
   start program  "/usr/iplanet/msg-ims-1/start-msg snmp"
   stop program  "/usr/iplanet/msg-ims-1/stop-msg snmp"
   group messaging
   if 5 restarts within 5 cycles then timeout
</pre>

<h3> iPlanetMessagingServer MMP (POP3/IMAP4/SMTP proxy)</h3>
<pre>
 check process mmp with pidfile /usr/iplanet/mmp-ims2/pidfile
   start program  "/usr/iplanet/mmp-ims2/AService.rc start"
   stop program  "/usr/iplanet/mmp-ims2/AService.rc stop"
   group messaging
   if 5 restarts within 5 cycles then timeout
   if failed host 192.168.1.2 port 110 protocol pop then restart
   if failed host 192.168.1.2 port 143 protocol imap then restart
</pre>

<h3><a name="iplanetcal">iPlanetCalendarServer csadmind</a></h3>
<pre>
 check process calendar-admin with pidfile /usr/iplanet/SUNWics5/cal/bin/config/pidfile.admin
   start program  "/usr/iplanet/SUNWics5/cal/bin/csstart service admin"
   stop program  "/usr/iplanet/SUNWics5/cal/bin/csstop service admin"
   group calendar
   if 5 restarts within 5 cycles then timeout
</pre>

<h3> iPlanetCalendarServer cshttpd</h3>
<pre>
 check process calendar-http with pidfile /usr/iplanet/SUNWics5/cal/bin/config/pidfile.http
   start program  "/usr/iplanet/SUNWics5/cal/bin/csstart service http"
   stop program  "/usr/iplanet/SUNWics5/cal/bin/csstop service http"
   group calendar
   if 5 restarts within 5 cycles then timeout
   if failed host 192.168.1.3 port 80 protocol http then restart
</pre>

<h3> iPlanetCalendarServer csdwpd (database wire protocol)</h3>
<pre>
 check process calendar-dwp with pidfile /usr/iplanet/SUNWics5/cal/bin/config/pidfile.dwp
   start program  "/usr/iplanet/SUNWics5/cal/bin/csstart service dwp"
   stop program  "/usr/iplanet/SUNWics5/cal/bin/csstop service dwp"
   group calendar
   if 5 restarts within 5 cycles then timeout
   if failed host 192.168.1.3 port 9779 protocol dwp then restart
   if cpu usage > 2% for 5 cycles then restart   # There's a leak in csdwpd
</pre>

<h3> iPlanetCalendarServer csnotifyd</h3>
<pre>
 check process calendar-notify with pidfile /usr/iplanet/SUNWics5/cal/bin/config/pidfile.notify
   start program  "/usr/iplanet/SUNWics5/cal/bin/csstart service notify"
   stop program  "/usr/iplanet/SUNWics5/cal/bin/csstop service notify"
   group calendar
   if 5 restarts within 5 cycles then timeout
</pre>

<h3> iPlanetCalendarServer enpd (event notification service broker)</h3>
<pre>
 check process calendar-ens with pidfile /usr/iplanet/SUNWics5/cal/bin/config/pidfile.ens
   start program  "/usr/iplanet/SUNWics5/cal/bin/csstart service ens"
   stop program  "/usr/iplanet/SUNWics5/cal/bin/csstop service ens"
   group calendar
   if 5 restarts within 5 cycles then timeout
   if failed host 192.168.1.3 port 7997 then restart
</pre>


<h2>Misc Services</h2>
<h3><a name="apcupsd">Apcupsd (APC ups daemon)</a></h3>
<pre>
 check process apcupsd with pidfile /var/run/apcupsd.pid
   group ups
   start program = "/etc/init.d/apcupsd start"
   stop  program = "/etc/init.d/apcupsd stop"
   if 5 restarts within 5 cycles then timeout
   if failed host 192.168.1.3 port 7000 type TCP  then restart
   depends on apcupsd_bin
   depends on apcupsd_rc

 check file apcupsd_bin with path /opt/apcupsd/sbin/apcupsd
   group ups
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor

 check file apcupsd_rc with path /etc/init.d/apcupsd
   group ups
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor
</pre>

<h3><a name="webmin">Webmin (remote admin service)</a></h3>
<pre>
 check process webmin with pidfile /var/webmin/miniserv.pid
   group webmin
   start program = "/etc/init.d/webmin start"
   stop  program = "/etc/init.d/webmin stop"
   if failed host 192.168.1.3 port 10000 then restart
   if 5 restarts within 5 cycles then timeout

 check file webmin_rc with path /etc/init.d/webmin
   group webmin
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor
</pre>

<h3><a name="stunnel">STunnel (SSL tunnel)</a></h3>
<pre>
 check process stunnel_pop3 with pidfile /opt/var/stunnel/stunnel.110.pid
   start program = "/etc/init.d/stunnel start_pop3"
   stop  program = "/etc/init.d/stunnel stop_pop3"
   if failed host 192.168.1.1 port 143 type TCPSSL protocol POP then restart
   group stunnel
   depends stunnel_init
   depends stunnel_bin

 check process stunnel_swat with pidfile /opt/var/stunnel/stunnel.901.pid
   start program = "/etc/init.d/stunnel start_swat"
   stop  program = "/etc/init.d/stunnel stop_swat"
   if failed host 192.168.1.1 port 995 type TCPSSL then restart
   group stunnel
   depends stunnel_bin
   depends stunnel_rc

 check file stunnel_bin with path /opt/sbin/stunnel
   group stunnel
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor

 check file stunnel_rc with path /etc/init.d/stunnel
   group stunnel
   if failed checksum then unmonitor
   if failed permission 755 then unmonitor
   if failed uid root then unmonitor
   if failed gid root then unmonitor
</pre>

<h2>Misc Usage</h2>
<h3><a name="coresol">Watch and analyze httpd crashdumps (Solaris)</a></h3>
Setuid coredump allowed:
<pre>
coreadm -e proc-setid
</pre>

Monit set to watch the core timestamp change and send the backtrace:
<pre>
 check file httpd_core with path /usr/apache/core
   if changed timestamp
      then exec "/bin/bash -c '/usr/bin/pstack /usr/apache/core | mailx -s httpd_crash foo@bar'"
</pre>

<h3><a name="corelin">Watch and analyze httpd crashdumps (Linux)</a></h3>
Central coredump prepared:
<pre>
 mkdir -p /var/crash/core
 chmod 1777 /var/crash/core
 sysctl -w kernel.core_pattern = /var/crash/core/core.%e.%t.%p
 sysctl -w kernel.core_setuid_ok = 0
 sysctl -w kernel.core_uses_pid = 1
 echo -e "bt\nquit" &gt; /etc/gdb.batch
 echo "ulimit -c unlimited" &gt;&gt; /etc/sysconfig/httpd
 echo "CoreDumpDirectory /var/crash/core" &gt; /etc/httpd/conf.d/core.conf
</pre>

Crontab based core aging:
<pre>
 10 1 * * * /usr/bin/find /var/crash/core/ -type f -mtime +1 -exec rm -f {} \;
</pre>

Monit set to watch the directory timestamp change and send last core backtrace:
<pre>
 check directory httpd_core with path /var/crash/core
   if changed timestamp then exec "/bin/bash -c 'if [ `/bin/cat /tmp/monit_httpd_core.tmp | head -1` != `/bin/ls /var/crash/core/core.httpd* | tail -1` ]; then /usr/bin/gdb -x /etc/gdb.batch /usr/sbin/httpd `/bin/ls /var/crash/core/core.httpd* | tail -1 | tee /tmp/monit_httpd_core.tmp` | mail -s httpd_crash admin@foo.bar webmaster@foo.bar; fi'"
</pre>


<h3><a name="tcpdump1">Start and stop tcpdump based on condition</a></h3>
As soon as the remote SMTP service of host bar is not available tcpdump is started.
When the connection is available again, tcpdump is stopped. Only first
ocurrence is catched (noexec flag is created to prevent another outage monitoring).
<pre>
 check host bar with address 10.1.1.2
   if failed port 25 protocol smtp then exec "/bin/bash -c 'if [ ! -f /tmp/noexec ]; then touch /tmp/noexec; tcpdump -w /tmp/foo_bar.dump host bar; fi'" else if recovered then exec "killall tcpdump"
</pre>


<h3><a name="tcpdump2">Rotate tcpdump until condition occures</a></h3>
This allows to let tcpdump write the data to file and rotate it to keep the size of
the dump small until network problem occures (we don't need to flood the filesystem
with data which are ok). As soon as the problem occures, monit sets noexec flag
=> the dump contains the data which preceded the problem as well.

Script for tcpdump and rotation created (/tmp/dumprotate):
<pre>
 #!/bin/bash
 killall tcpdump
 if [ ! -f /tmp/noexec ]
 then
   tcpdump -w /tmp/foo_bar.dump host bar
 fi
</pre>

The script is started from cron each 30 minutes:
<pre>
 0,30 * * * * /tmp/dumprotate
</pre>

Monit watches the host availablity and as soon as it failed, sets noexec flag
(with 5 minutes extent):
<pre>
 check host bar with address 10.1.1.2
   if failed port 25 protocol smtp then exec "/bin/bash -c 'sleep 300; touch /tmp/noexec'"
</pre>


<h3><a name="mysqldproc"">MySQL event driven process list</a></h3>
This allows to obtain process list of mysql threads as soon as mysql
refuses connections. For example we needed to know why mysql
returned "Too many connections" to clients occasionaly. (note that
for simplicity in this example is showed mysql root account without
password - you realy should use restricted account ;)

<pre>
 check process mysqld with pidfile /var/run/mysqld.pid
   if failed port 3306 protocol mysql then exec "/bin/bash -c '(date && /usr/bin/mysqladmin -u root processlist && echo) >> /tmp/mysql_processlist'"
</pre>


<?php include '../include/footer.html'; ?>
