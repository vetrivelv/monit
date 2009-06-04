<?php include '../include/header.html'; ?>

<center>
<table width="680"><tr> <td><img src="index.gif"></td></tr></table>
</center>

<?php include '../include/menu.php'; ?>

<h2>Manual</h2>

<p>Updated for release 4.10.1

<p><a name="__index__"></a></p>
<!-- INDEX BEGIN -->

<ul>

	<li><a href="#name">NAME</a></li>
	<li><a href="#synopsis">SYNOPSIS</a></li>
	<li><a href="#description">DESCRIPTION</a></li>
	<li><a href="#general_operation">GENERAL OPERATION</a></li>
	<ul>

		<li><a href="#general_options_and_arguments">General Options and Arguments</a></li>
	</ul>

	<li><a href="#what_to_monitor">WHAT TO MONITOR</a></li>
	<li><a href="#how_to_monitor">HOW TO MONITOR</a></li>
	<li><a href="#logging">LOGGING</a></li>
	<li><a href="#daemon_mode">DAEMON MODE</a></li>
	<li><a href="#init_support">INIT SUPPORT</a></li>
	<li><a href="#include_files">INCLUDE FILES</a></li>
	<li><a href="#group_support">GROUP SUPPORT</a></li>
	<li><a href="#monitoring_mode">MONITORING MODE</a></li>
	<li><a href="#alert_messages">ALERT MESSAGES</a></li>
	<ul>

		<li><a href="#setting_a_global_alert_statement">Setting a global alert statement</a></li>
		<li><a href="#setting_a_local_alert_statement">Setting a local alert statement</a></li>
		<li><a href="#alert_message_layout">Alert message layout</a></li>
		<li><a href="#setting_a_global_mail_format">Setting a global mail format</a></li>
		<li><a href="#setting_a_error_reminder">Setting a error reminder</a></li>
		<li><a href="#setting_a_mail_server_for_alert_messages">Setting a mail server for alert messages</a></li>
		<li><a href="#event_queue">Event queue</a></li>
	</ul>

	<li><a href="#service_timeout">SERVICE TIMEOUT</a></li>
	<li><a href="#service_tests">SERVICE TESTS</a></li>
	<ul>

		<li><a href="#resource_testing">RESOURCE TESTING</a></li>
		<li><a href="#file_checksum_testing">FILE CHECKSUM TESTING</a></li>
		<li><a href="#timestamp_testing">TIMESTAMP TESTING</a></li>
		<li><a href="#file_size_testing">FILE SIZE TESTING</a></li>
		<li><a href="#file_content_testing">FILE CONTENT TESTING</a></li>
		<li><a href="#filesystem_flags_testing">FILESYSTEM FLAGS TESTING</a></li>
		<li><a href="#space_testing">SPACE TESTING</a></li>
		<li><a href="#inode_testing">INODE TESTING</a></li>
		<li><a href="#permission_testing">PERMISSION TESTING</a></li>
		<li><a href="#uid_testing">UID TESTING</a></li>
		<li><a href="#gid_testing">GID TESTING</a></li>
		<li><a href="#pid_testing">PID TESTING</a></li>
		<li><a href="#ppid_testing">PPID TESTING</a></li>
		<li><a href="#connection_testing">CONNECTION TESTING</a></li>
		<ul>

			<ul>

				<li><a href="#connection_testing_using_the_url_notation">Connection testing using the URL notation</a></li>
				<li><a href="#remote_host_ping_test">Remote host ping test</a></li>
				<li><a href="#examples">Examples</a></li>
			</ul>

		</ul>

	</ul>

	<li><a href="#monit_httpd">MONIT HTTPD</a></li>
	<ul>

		<li><a href="#monit_httpd_authentication">Monit HTTPD Authentication</a></li>
		<ul>

			<ul>

				<li><a href="#host_and_network_allow_list">Host and network allow list</a></li>
				<li><a href="#basic_authentication">Basic Authentication</a></li>
			</ul>

		</ul>

	</ul>

	<li><a href="#dependencies">DEPENDENCIES</a></li>
	<li><a href="#the_run_control_file">THE RUN CONTROL FILE</a></li>
	<ul>

		<li><a href="#run_control_syntax">Run Control Syntax</a></li>
		<li><a href="#configuration_examples">CONFIGURATION EXAMPLES</a></li>
	</ul>

	<li><a href="#monit_with_heartbeat">MONIT WITH HEARTBEAT</a></li>
	<ul>

		<li><a href="#handling_state">Handling state</a></li>
	</ul>

	<li><a href="#files">FILES</a></li>
	<li><a href="#environment">ENVIRONMENT</a></li>
	<li><a href="#signals">SIGNALS</a></li>
	<li><a href="#notes">NOTES</a></li>
	<li><a href="#authors">AUTHORS</a></li>
	<li><a href="#copyright">COPYRIGHT</a></li>
	<li><a href="#see_also">SEE ALSO</a></li>
</ul>
<!-- INDEX END -->

<hr />
<p>
</p>
<h1><a name="name">NAME</a></h1>
<p>monit - utility for monitoring services on a Unix system</p>
<p>
</p>
<hr />
<h1><a name="synopsis">SYNOPSIS</a></h1>
<p><strong>monit</strong> [options] {arguments}</p>
<p>
</p>
<hr />
<h1><a name="description">DESCRIPTION</a></h1>
<p><strong>monit</strong> is a utility for managing and monitoring processes,
files, directories and devices on a Unix system. Monit conducts
automatic maintenance and repair and can execute meaningful
causal actions in error situations. E.g. monit can start a
process if it does not run, restart a process if it does not
respond and stop a process if it uses too much resources. You may
use monit to monitor files, directories and devices for changes,
such as timestamps changes, checksum changes or size changes.</p>
<p>Monit is controlled via an easy to configure control file based
on a free-format, token-oriented syntax. Monit logs to syslog or
to its own log file and notifies you about error conditions via
customizable alert messages. Monit can perform various TCP/IP
network checks, protocol checks and can utilize SSL for such
checks. Monit provides a <code>http(s)</code> interface and you may use a
browser to access the monit program.</p>
<p>
</p>
<hr />
<h1><a name="general_operation">GENERAL OPERATION</a></h1>
<p>The behavior of monit is controlled by command-line options
<em>and</em> a run control file, <em>~/.monitrc</em>, the syntax of which we
describe in a later section. Command-line options override
<em>.monitrc</em> declarations.</p>
<p>The following options are recognized by monit. However, it is
recommended that you set options (when applicable) directly in
the <em>.monitrc</em> control file.</p>
<p>
</p>
<h2><a name="general_options_and_arguments">General Options and Arguments</a></h2>
<p><strong>-c</strong> <em>file</em>
   Use this control file</p>
<p><strong>-d</strong> <em>n</em>
   Run as a daemon once per <em>n</em> seconds</p>
<p><strong>-g</strong> 
   Set group name for start, stop, restart and status</p>
<p><strong>-l</strong> <em>logfile</em>
   Print log information to this file</p>
<p><strong>-p</strong> <em>pidfile</em>
   Use this lock file in daemon mode</p>
<p><strong>-s</strong> <em>statefile</em>
   Write state information to this file</p>
<p><strong>-I</strong>
   Do not run in background (needed for run from init)</p>
<p><strong>-t</strong>
   Run syntax check for the control file</p>
<p><strong>-v</strong>
   Verbose mode, work noisy (diagnostic output)</p>
<p><strong>-H</strong> <em>[filename]</em>
   Print MD5 and SHA1 hashes of the file or of stdin if the 
   filename is omitted; monit will exit afterwards</p>
<p><strong>-V</strong>
   Print version number and patch level</p>
<p><strong>-h</strong>
   Print a help text</p>
<p>In addition to the options above, monit can be started with one
of the following action arguments; monit will then execute the
action and exit without transforming itself to a daemon.</p>
<p><strong>start all</strong>
   Start all services listed in the control file and 
   enable monitoring for them. If the group option is 
   set, only start and enable monitoring of services in
   the named group.</p>
<p><strong>start name</strong>
   Start the named service and enable monitoring for 
   it. The name is a service entry name from the 
   monitrc file.</p>
<p><strong>stop all</strong>     
   Stop all services listed in the control file and 
   disable their monitoring. If the group option is 
   set, only stop and disable monitoring of the services 
   in the named group.</p>
<p><strong>stop name</strong>
   Stop the named service and disable its monitoring. 
   The name is a service entry name from the monitrc 
   file.</p>
<p><strong>restart all</strong>
   Stop and start <em>all</em> services. If the group option 
   is set, only restart the services in the named group.</p>
<p><strong>restart name</strong>
   Restart the named service. The name is a service entry 
   name from the monitrc file.</p>
<p><strong>monitor all</strong>     
   Enable monitoring of all services listed in the
   control file. If the group option is set, only start
   monitoring of services in the named group.</p>
<p><strong>monitor name</strong>
   Enable monitoring of the named service.  The name is
   a service entry name from the monitrc file. Monit will
   also enable monitoring of all services this service 
   depends on.</p>
<p><strong>unmonitor all</strong>     
   Disable monitoring of all services listed in the
   control file. If the group option is set, only disable
   monitoring of services in the named group.</p>
<p><strong>unmonitor name</strong>
   Disable monitoring of the named service. The name is
   a service entry name from the monitrc file. Monit 
   will also disable monitoring of all services that 
   depends on this service.</p>
<p><strong>status</strong>
    Print full status information for each service.</p>
<p><strong>summary</strong>
    Print short status information for each service.</p>
<p><strong>reload</strong>
    Reinitialize a running monit daemon, the daemon will
    reread its configuration, close and reopen log files.</p>
<p><strong>quit</strong>
    Kill a monit daemon process</p>
<p><strong>validate</strong>
   Check all services listed in the control file. This 
   action is also the default behavior when monit runs 
   in daemon mode.</p>
<p>
</p>
<hr />
<h1><a name="what_to_monitor">WHAT TO MONITOR</a></h1>
<p>You may use monit to monitor daemon processes or similar programs
running on localhost. Monit is particular useful for monitoring
daemon processes, such as those started at system boot time from
/etc/init.d/. For instance sendmail, sshd, apache and mysql. In
difference to many monitoring systems, monit can act if an error
situation should occur, e.g.; if sendmail is not running, monit
can start sendmail or if apache is using too much system resources
(e.g. if a DoS attack is in progress) monit can stop or restart
apache and send you an alert message. Monit does also monitor
process characteristics, such as; if a process has become a
zombie and how much memory or cpu cycles a process is using.</p>
<p>You may also use monit to monitor files, directories and devices
on localhost. Monit can monitor these items for changes, such as
timestamps changes, checksum changes or size changes. This is
also useful for security reasons - you can monitor the md5
checksum of files that should not change.</p>
<p>You may even use monit to monitor remote hosts. First and
foremost monit is a utility for monitoring and mending services
on localhost, but if a service depends on a remote service,
e.g. a database server or an application server, it might by
useful to be able to test a remote host as well.</p>
<p>You may monitor the general system-wide resources such as cpu
usage, memory and load average.</p>
<p>
</p>
<hr />
<h1><a name="how_to_monitor">HOW TO MONITOR</a></h1>
<p>monit is configured and controlled via a control file called
<strong>monitrc</strong>. The default location for this file is ~/.monitrc. If
this file does not exist, monit will try /etc/monitrc, then
@sysconfdir@/monitrc and finally ./monitrc.</p>
<p>A monit control file consists of a series of service entries and
global option statements in a free-format, token-oriented syntax.
Comments begin with a # and extend through the end of the line.
There are three kinds of tokens in the control file: grammar
keywords, numbers and strings.</p>
<p>On a semantic level, the control file consists of three types of
statements:</p>
<ol>
<li><strong><a name="item_global_set_2dstatements">Global set-statements</a></strong>

<p>A global set-statement starts with the keyword <em>set</em> and the
item to configure.</p>
</li>
<li><strong><a name="item_global_include_2dstatement">Global include-statement</a></strong>

<p>The include statement consists of the keyword <em>include</em> and
a glob string.</p>
</li>
<li><strong><a name="item_one_or_more_service_entry_statements_2e">One or more service entry statements.</a></strong>

<p>A service entry starts with the keyword <em>check</em> followed by the
service type.</p>
</li>
</ol>
<p>This is the hello galaxy version of a monit control file:</p>
<pre>
 #
 # monit control file
 #</pre>
<pre>
 set daemon 120 # Poll at 2-minute intervals
 set logfile syslog facility log_daemon
 set alert foo@bar.baz
 set httpd port 2812 and use address localhost
     allow localhost   # Allow localhost to connect
     allow admin:monit # Allow Basic Auth</pre>
<pre>
 check system myhost.mydomain.tld
    if loadavg (1min) &gt; 4 then alert
    if loadavg (5min) &gt; 2 then alert
    if memory usage &gt; 75% then alert
    if cpu usage (user) &gt; 70% then alert
    if cpu usage (system) &gt; 30% then alert
    if cpu usage (wait) &gt; 20% then alert</pre>
<pre>
 check process apache 
    with pidfile &quot;/usr/local/apache/logs/httpd.pid&quot;
    start program = &quot;/etc/init.d/httpd start&quot;
    stop program = &quot;/etc/init.d/httpd stop&quot;
    if 2 restarts within 3 cycles then timeout
    if totalmem &gt; 100 Mb then alert
    if children &gt; 255 for 5 cycles then stop
    if cpu usage &gt; 95% for 3 cycles then restart
    if failed port 80 protocol http then restart
    group server
    depends on httpd.conf, httpd.bin</pre>
<pre>
 check file httpd.conf 
     with path /usr/local/apache/conf/httpd.conf
     # Reload apache if the httpd.conf file was changed
     if changed checksum 
        then exec &quot;/usr/local/apache/bin/apachectl graceful&quot;</pre>
<pre>
 check file httpd.bin 
     with path /usr/local/apache/bin/httpd
     # Run /watch/dog in the case that the binary was changed
     # and alert in the case that the checksum value recovered
     # later
     if failed checksum then exec &quot;/watch/dog&quot;
        else if recovered then alert</pre>
<pre>
 include /etc/monit/mysql.monitrc
 include /etc/monit/mail/*.monitrc</pre>
<p>This example illustrate a service entry for monitoring the apache
web server process as well as related files. The meaning of the
various statements will be explained in the following sections.</p>
<p>
</p>
<hr />
<h1><a name="logging">LOGGING</a></h1>
<p>monit will log status and error messages to a log file. Use the
<em>set logfile</em> statement in the monitrc control file. To setup
monit to log to its own logfile, use e.g. <em>set logfile
/var/log/monit.log</em>. If <strong>syslog</strong> is given as a value for the
<em>-l</em> command-line switch (or the keyword <em>set logfile syslog</em>
is found in the control file) monit will use the <strong>syslog</strong> system
daemon to log messages. The priority is assigned to each message
based on the context. To turn off logging, simply do not set
the logfile in the control file (and of course, do not use the -l
switch)</p>
<p>
</p>
<hr />
<h1><a name="daemon_mode">DAEMON MODE</a></h1>
<p>The <em>-d interval</em> command-line switch runs monit in daemon
mode. You must specify a numeric argument which is a polling
interval in seconds.</p>
<p>In daemon mode, monit detaches from the console, puts itself in
the background and runs continuously, monitoring each specified
service and then goes to sleep for the given poll interval.</p>
<pre>
       Simply invoking</pre>
<pre>
              monit -d 300</pre>
<p>will poll all services described in your <em>~/.monitrc</em> file every
5 minutes.</p>
<p>It is strongly recommended to set the poll interval in your
~/.monitrc file instead, by using <em>set daemon <strong>n</strong></em>, where <strong>n</strong>
is an integer number of seconds. If you do this, monit will
always start in daemon mode (as long as no action arguments are
given).</p>
<p>Monit makes a per-instance lock-file in daemon mode. If you need
more monit instances, you will need more configuration files,
each pointing to its own lock-file.</p>
<p>Calling <em>monit</em> with a monit daemon running in the background
sends a wake-up signal to the daemon, forcing it to check 
services immediately.</p>
<p>The <em>quit</em> argument will kill a running daemon process instead
of waking it up.</p>
<p>
</p>
<hr />
<h1><a name="init_support">INIT SUPPORT</a></h1>
<p>Monit can run and be controlled from <em>init</em>. If monit should
crash, <em>init</em> will re-spawn a new monit process. Using init to
start monit is probably the best way to run monit if you want to
be certain that you always have a running monit daemon on your
system. (It's obvious, but never the less worth to stress; Make
sure that the control file does not have any syntax errors before
you start monit from init. Also, make sure that if you run monit
from init, that you do not start monit from a startup scripts as
well).</p>
<p>To setup monit to run from init, you can either use the 'set
init' statement in monit's control file or use the -I option from
the command line and here is what you must add to /etc/inittab:</p>
<pre>
  # Run monit in standard run-levels
  mo:2345:respawn:/usr/local/bin/monit -Ic /etc/monitrc</pre>
<p>After you have modified init's configuration file, you can run
the following command to re-examine /etc/inittab and start monit:</p>
<pre>
  telinit q
  
For systems without telinit:</pre>
<pre>
  kill -1 1</pre>
<p>If monit is used to monitor services that are also started at
boot time (e.g. services started via SYSV init rc scripts or via
inittab) then, in some cases, a race condition could occur. That
is; if a service is slow to start, monit can assume that the
service is not running and possibly try to start it and raise an
alert, while, in fact the service is already about to start or
already in its startup sequence. Please see the FAQ for solutions
to this problem.</p>
<p>
</p>
<hr />
<h1><a name="include_files">INCLUDE FILES</a></h1>
<p>The monit control file, <em>monitrc</em>, can include additional
configuration files. This feature helps to maintain a certain
structure or to place repeating settings into one file. Include
statements can be placed at virtually any spot. The syntax is the
following:</p>
<pre>
  INCLUDE globstring</pre>
<p>The globstring is any kind of string as defined in glob(7).
Thus, you can refer to a single file or you can load several
files at once.  In case you want to use whitespace in your string
the globstring need to be embedded into quotes (') or double
quotes (``). For example,</p>
<pre>
 INCLUDE &quot;/etc/monit/monit configuration files/printer.*.monitrc&quot;</pre>
<p>loads any file matching the single globstring.  If the globstring
matches a directory instead of a file, it is silently ignored.</p>
<p><em>INCLUDE</em> statements in included files are parsed as in the main
control file.</p>
<p>If the globstring matches several results, the files are included
in a non sorted manner.  If you need to rely on a certain order,
you might need to use single <em>include</em> statements.</p>
<p>
</p>
<hr />
<h1><a name="group_support">GROUP SUPPORT</a></h1>
<p>Service entries in the control file, <em>monitrc</em>, can be grouped
together by the <em>group</em> statement. The syntax is simply (keyword
in capital):</p>
<pre>
  GROUP groupname</pre>
<p>With this statement it is possible to group similar service
entries together and manage them as a whole. Monit provides
functions to start, stop and restart a group of services, like
so:</p>
<p>To start a group of services from the console:</p>
<pre>
  monit -g &lt;groupname&gt; start</pre>
<p>To stop a group of services:</p>
<pre>
  monit -g &lt;groupname&gt; stop</pre>
<p>To restart a group of services:</p>
<pre>
  monit -g &lt;groupname&gt; restart</pre>
<p>
</p>
<hr />
<h1><a name="monitoring_mode">MONITORING MODE</a></h1>
<p>Monit supports three monitoring modes per service: <em>active</em>,
<em>passive</em> and <em>manual</em>. See also the example section below for
usage of the mode statement.</p>
<p>In <em>active</em> mode, monit will monitor a service and in case of
problems monit will act and raise alerts, start, stop or restart
the service. Active mode is the default mode.</p>
<p>In <em>passive</em> mode, monit will passively monitor a service and
specifically <strong>not</strong> try to fix a problem, but it will still raise
alerts in case of a problem.</p>
<p>For use in clustered environments there is also a <em>manual</em>
mode. In this mode, monit will enter <em>active</em> mode <strong>only</strong> if a
service was brought under monit's control, for example by
executing the following command in the console:</p>
<pre>
  monit start sybase 
  (monit will call sybase's start method and enable monitoring)</pre>
<p>If a service was not started by monit or was stopped or disabled
for example by:</p>
<pre>
  monit stop sybase 
  (monit will call sybase's stop method and disable monitoring)</pre>
<p>monit will not monitor the service. This allows for having
services configured in monitrc and start it with monit only if it
should run. This feature can be used to build a simple failsafe
cluster. To see how, read more about how to setup a cluster with
monit using the <em>heartbeat</em> system in the examples sections
below.</p>
<p>
</p>
<hr />
<h1><a name="alert_messages">ALERT MESSAGES</a></h1>
<p>Monit will raise an email alert in the following situations:</p>
<pre>
 o A service timed out
 o A service does not exist
 o A service related data access problem
 o A service related program execution problem
 o A service is of invalid object type
 o A icmp problem
 o A port connection problem
 o A resource statement match
 o A file checksum problem
 o A file size problem
 o A file/directory timestamp problem
 o A file/directory/device permission problem
 o A file/directory/device uid problem
 o A file/directory/device gid problem</pre>
<p>Monit will send an alert each time a monitored object changed.
This involves:</p>
<pre>
 o Monit started, stopped or reloaded
 o A file checksum changed
 o A file size changed
 o A file content match
 o A file/directory timestamp changed</pre>
<p>You use the alert statement to notify monit that you want alert
messages sent to an email address. If you do not specify an alert
statement, monit will not send alert messages.</p>
<p>There are two forms of alert statement:</p>
<pre>
 o Global - common for all services
 o Local  - per service</pre>
<p>In both cases you can use more than one alert statement. In other
words, you can send many different emails to many different
addresses. (in case you now got a new business idea: monit is not
really suitable for sending spam).</p>
<p>Recipients in the global and in the local lists are alerted when
a service failed, recovered or changed. If the same email address
is in the global and in the local list, monit will send only one
alert. Local (per service) defined alert email addresses override
global addresses in case of a conflict. Finally, you may choose
to only use a global alert list (recommended), a local per
service list or both.</p>
<p>It is also possible to disable the global alerts localy for
particular <code>service(s)</code> and recipients.</p>
<p>
</p>
<h2><a name="setting_a_global_alert_statement">Setting a global alert statement</a></h2>
<p>If a change occurred on a monitored services, monit will send an
alert to all recipients in the global list who have registered
interest for the event type. Here is the syntax for the global
alert statement:</p>
<dl>
<dt><strong><a name="item_set_alert_mail_2daddress__5b__5bnot_5d__7bevents_7">SET ALERT mail-address [ [NOT] {events}] [MAIL-FORMAT 
          {mail-format}] [REMINDER number]</a></strong></dt>

</dl>
<p>Simply using the following in the global section of monitrc:</p>
<pre>
 set alert foo@bar</pre>
<p>will send a default email to the address foo@bar whenever an
event occurred on any service. Such an event may be that a
service timed out, a service was doesn't exist or a service does
exist (on recovery) and so on. If you want to send alert messages
to more email addresses, add a <em>set alert 'email'</em> statement for
each address.</p>
<p>For explanations of the <em>events, MAIL-FORMAT and REMINDER</em>
keywords above, please see below.</p>
<p>When you want to enable global alert recipient which will receive
all event alerts except some type, you can also use the NOT negation
option ahead of events list which allows you to set the recipient
for ``all but specified events'' (see bellow for more details).</p>
<p>
</p>
<h2><a name="setting_a_local_alert_statement">Setting a local alert statement</a></h2>
<p>Each service can also have its own recipient list.</p>
<dl>
<dt><strong><a name="item_alert_mail_2daddress__5b__5bnot_5d__7bevents_7d_5d">ALERT mail-address [ [NOT] {events}] [MAIL-FORMAT 
           {mail-format}] [REMINDER number]</a></strong></dt>

</dl>
<p>or</p>
<dl>
<dt><strong><a name="item_noalert_mail_2daddress">NOALERT mail-address</a></strong></dt>

</dl>
<p>If you only want an alert message sent for certain events for
certain service(s), for example only for timeout events or only
if a service died, then postfix the alert-statement with a filter
block:</p>
<pre>
 check process myproc with pidfile /var/run/my.pid
   alert foo@bar only on { timeout, nonexist } 
   ...</pre>
<p>(<em>only</em> and <em>on</em> are noise keywords, ignored by monit. As a
side note; Noise keywords are used in the control file grammar to
make an entry resemble English and thus make it easier to read
(or, so goes the philosophy). The full set of available noise
keywords are listed below in the Control File section).</p>
<p>You can also set the alert to send all events except specified
using the list negation - the word <em>not</em> ahead of the event
list. For example when you want to receive alerts for all events
except the monit instance related, you can write (note that the
noise words 'but' and 'on' are optional):</p>
<pre>
 check system myserver
   alert foo@bar but not on { instance } 
   ...</pre>
<p>instead of:</p>
<pre>
   alert foo@bar on { change
                      checksum
                      data
                      exec
                      gid
                      icmp
                      invalid
                      match
                      nonexist
                      permission
                      size
                      timeout
                      timestamp }</pre>
<p>This will enable all alerts for foo@bar, except the monit instance
related alerts.</p>
<p>Event filtering can be used to send a mail to different email
addresses depending on the events that occurred. For instance:</p>
<pre>
 alert foo@bar { nonexist, timeout, resource, icmp, connection }
 alert security@bar on { checksum, permission, uid, gid }
 alert manager@bar</pre>
<p>This will send an alert message to foo@bar whenever a nonexist,
timeout, resource or connection problem occurs and a message to
security@bar if a checksum, permission, uid or gid problem
occurs. And finally, a message to manager@bar whenever any error
event occurs.</p>
<p>This is the list of events you can use in a mail-filter: <em>uid,
gid, size, nonexist, data, icmp, instance, invalid, exec,
changed, timeout, resource, checksum, match, timestamp,
connection, permission</em></p>
<p>You can also disable the alerts localy using the NOALERT statement.
This is useful for example when you have lot of services monitored,
used the global alert statement, but don't want  to receive alerts
for some minor subset of services:</p>
<pre>
 noalert appadmin@bar</pre>
<p>For example when you will place the noalert statement to the
'check system', the given user won't receive the system related
alerts (such as monit instance started/stopped/reloaded alert,
system overloaded alert, etc.) but will receive the alerts for
all other monitored services.</p>
<p>The following example will alert foo@bar on all events on all
services by default, except the service mybar which will send an
alert only on timeout. The trick is based on the fact that local
definition of the same recipient overrides the global setting
(including registered events and mail format):</p>
<pre>
 set alert foo@bar
 
 check process myfoo with pidfile /var/run/myfoo.pid
   ...
 check process mybar with pidfile /var/run/mybar.pid
   alert foo@bar only on { timeout }</pre>
<p>The 'instance' alert type report events related to monit
internals, such as when a monit instance was started, stopped or
reloaded.</p>
<p>If the MTA (mailserver) for sending alerts is not available,
monit <em>can</em> queue events on the local file-system until the MTA
recover. Monit will then post queued events in order with their
original timestamp so the events are not lost. This feature is
most useful if monit is used together with e.g. m/monit and when
event history is important.</p>
<p>
</p>
<h2><a name="alert_message_layout">Alert message layout</a></h2>
<p>monit provides a default mail message layout that is short and to
the point. Here's an example of a standard alert mail sent by
monit:</p>
<pre>
 From: monit@tildeslash.com
 Subject: monit alert -- Does not exist apache 
 To: hauk@tildeslash.com
 Date: Thu, 04 Sep 2003 02:33:03 +0200</pre>
<pre>
 Does not exist Service apache</pre>
<pre>
        Date:   Thu, 04 Sep 2003 02:33:03 +0200
        Action: restart
        Host:   www.tildeslash.com</pre>
<pre>
 Your faithful employee,
 monit</pre>
<p>If you want to, you can change the format of this message with
the optional <em>mail-format</em> statement. The syntax for this
statement is as follows:</p>
<pre>
 mail-format {
      from: monit@localhost
   subject: $SERVICE $EVENT at $DATE
   message: Monit $ACTION $SERVICE at $DATE on $HOST: $DESCRIPTION.
            Yours sincerely,
            monit
 }</pre>
<p>Where the keyword <em>from:</em> is the email address monit should
pretend it is sending from. It does not have to be a real mail
address, but it must be a proper formated mail address, on the
form: name@domain. The keyword <em>subject:</em> is for the email
subject line. The subject must be on only <em>one</em> line. The
<em>message:</em> keyword denotes the mail body. If used, this keyword
should always be the last in a mail-format statement.  The mail
body can be as long as you want and must <strong>not</strong> contain the '}'
character.</p>
<p>All of these format keywords are optional but you must provide at
least one. Thus if you only want to change the from address monit
is using you can do:</p>
<pre>
 set alert foo@bar with mail-format { from: bofh@bar.baz }</pre>
<p>From the previous example you will notice that some special $XXX
variables was used. If used, they will be substituted and
expanded into the text with these values:</p>
<ul>
<li><strong><a name="item__event"><em>$EVENT</em></a></strong>

<pre>
 A string describing the event that occurred. The values are
 fixed and are:</pre>
<pre>
 Event:    | Failure state:          | Recovery state:
 ---------------------------------------------------------------
 CHANGED   | &quot;Changed&quot;               | &quot;Changed back&quot;
 CHECKSUM  | &quot;Checksum failed&quot;       | &quot;Checksum succeeded&quot;
 CONNECTION| &quot;Connection failed&quot;     | &quot;Connection succeeded&quot;
 DATA      | &quot;Data access error&quot;     | &quot;Data access succeeded&quot;
 EXEC      | &quot;Execution failed&quot;      | &quot;Execution succeeded&quot;
 GID       | &quot;GID failed&quot;            | &quot;GID succeeded&quot;
 ICMP      | &quot;ICMP failed&quot;           | &quot;ICMP succeeded&quot;
 INSTANCE  | &quot;Monit instance changed&quot;| &quot;Monit instance changed not&quot;
 INVALID   | &quot;Invalid type&quot;          | &quot;Type succeeded&quot;
 MATCH     | &quot;Regex match&quot;           | &quot;No regex match&quot;
 NONEXIST  | &quot;Does not exist&quot;        | &quot;Exists&quot;
 PERMISSION| &quot;Permission failed&quot;     | &quot;Permission succeeded&quot;
 RESOURCE  | &quot;Resource limit matched&quot;| &quot;Resource limit succeeded&quot;
 SIZE      | &quot;Size failed&quot;           | &quot;Size succeeded&quot;
 TIMEOUT   | &quot;Timeout&quot;               | &quot;Timeout recovery&quot;
 TIMESTAMP | &quot;Timestamp failed&quot;      | &quot;Timestamp succeeded&quot;
 UID       | &quot;UID failed&quot;            | &quot;UID succeeded&quot;</pre>
</li>
<li><strong><a name="item__service"><em>$SERVICE</em></a></strong>

<pre>
 The service entry name in monitrc</pre>
</li>
<li><strong><a name="item__date"><em>$DATE</em></a></strong>

<pre>
 The current time and date (RFC 822 date style).</pre>
</li>
<li><strong><a name="item__host"><em>$HOST</em></a></strong>

<pre>
 The name of the host monit is running on</pre>
</li>
<li><strong><a name="item__action"><em>$ACTION</em></a></strong>

<pre>
 The name of the action which was done. Action names are fixed
 and are:</pre>
<pre>
 Action:  | Name:
 --------------------
 ALERT    | &quot;alert&quot;
 EXEC     | &quot;exec&quot;
 MONITOR  | &quot;monitor&quot;
 RESTART  | &quot;restart&quot;
 START    | &quot;start&quot;
 STOP     | &quot;stop&quot;
 UNMONITOR| &quot;unmonitor&quot;</pre>
</li>
<li><strong><a name="item__description"><em>$DESCRIPTION</em></a></strong>

<pre>
 The description of the error condition</pre>
</li>
</ul>
<p>
</p>
<h2><a name="setting_a_global_mail_format">Setting a global mail format</a></h2>
<p>It is possible to set a standard mail format with the
following global set-statement (keywords are in capital):</p>
<dl>
<dt><strong><a name="item_set_mail_2dformat__7bmail_2dformat_7d">SET MAIL-FORMAT {mail-format}</a></strong></dt>

</dl>
<p>Format set with this statement will apply to every alert
statement that does <em>not</em> have its own specified mail-format.
This statement is most useful for setting a default from address
for messages sent by monit, like so:</p>
<pre>
 set mail-format { from: monit@foo.bar.no }</pre>
<p>
</p>
<h2><a name="setting_a_error_reminder">Setting a error reminder</a></h2>
<p>Monit by default sends just one error notification when the
service failed and another one when it has recovered. If you want
to be notified more then once in the case that the service
remains failed, you can use the reminder option of alert
statement (keywords are in capital):</p>
<dl>
<dt><strong><a name="item_alert__2e_2e_2e__5bwith_5d_reminder__5bon_5d_numbe">ALERT ... [WITH] REMINDER [ON] number [CYCLES]</a></strong></dt>

</dl>
<p>For example if you want to be notified each tenth cycle when the
service remains failed, you can use:</p>
<pre>
  alert foo@bar with reminder on 10 cycles</pre>
<p>If you want to be notified on each failed cycle, you can use:</p>
<pre>
  alert foo@bar with reminder on 1 cycle</pre>
<p>
</p>
<h2><a name="setting_a_mail_server_for_alert_messages">Setting a mail server for alert messages</a></h2>
<p>The mail server monit should use to send alert messages is
defined with a global set statement (keywords are in capital and
optional statements in [brackets]):</p>
<pre>
 SET MAILSERVER {hostname|ip-address [PORT port]
                [USERNAME username] [PASSWORD password]
                [using SSLV2|SSLV3|TLSV1] [CERTMD5 checksum]}+ 
                [with TIMEOUT X SECONDS]</pre>
<p>The port statement allows to use SMTP servers other then those
listening on port 25. If omitted, port 25 is used when ssl is not
enabled or tls is used, otherwise 465 is used by default (for ssl
v2 and v3).</p>
<p>Monit support plain smtp authentication - you can set the username
and password using USERNAME and PASSWORD options.</p>
<p>To use the secure communication, use the SSLV2, SSLV3 or TLSV1
options, you can also specify the server certificate checksum
using CERTMD5 option.</p>
<p>As you can see, it is possible to set several SMTP servers. If
monit cannot connect to the first server in the list it will try
the second server and so on. Monit has a default 5 seconds
connection timeout and if the SMTP server is slow, monit could
timeout when connecting or reading from the server.  You can use
the optional timeout statement to explicit set the timeout to a
higher value if needed. Here is an example for setting several
mail servers:</p>
<pre>
 set mailserver mail.tildeslash.com,
                mail.foo.bar port 10025 username &quot;Rabbi&quot; password &quot;Loewe&quot; using tlsv1, 
                localhost
                with timeout 15 seconds</pre>
<p>Here monit will first try to connect to the server
``mail.tildeslash.com'', if this server is down monit will try
``mail.foo.bar'' on port 10025 using the given credentials via tls and
finally ``localhost''. We do also set an explicit connect and read
timeout; If monit cannot connect to the first SMTP server in the
list within 15 seconds it will try the next server and so on.
The <em>set mailserver ..</em> statement is optional and if not defined
monit defaults to use localhost as
the SMTP server.</p>
<p>
</p>
<h2><a name="event_queue">Event queue</a></h2>
<p>Monit provide optionally queueing of event alerts that cannot be
sent. For example, if no mail-server is available at the moment,
monit can store events in a queue and try to reprocess them at
the next cycle. As soon as the mail-server recover, monit will
post the queued events. The queue is persistent across monit
restarts and provided that the back-end filesystem is persistent
too, across system restart as well.</p>
<p>By default, the queue is disabled and if the alert handler fails,
monit will simply drop the alert message. To enable the event
queue, add the following statement to the monit control file:</p>
<pre>
 SET EVENTQUEUE BASEDIR &lt;path&gt; [SLOTS &lt;number&gt;]</pre>
<p>The &lt;path&gt; is the path to the directory where events will be
stored. Optionally if you want to limit the queue size (maximum
events count), use the slots option. If the slots option is not
used, monit will store as many events as the backend filesystem
allows.</p>
<p>Example:</p>
<pre>
  set eventqueue
      basedir /var/monit
      slots 5000</pre>
<p>The events are stored in binary format, one file per event. The
file size is ca. 130 bytes or a bit more (depending on the
message length). The file name is composed of the unix timestamp,
underscore and the service name, for example:</p>
<pre>
 /var/monit/1131269471_apache</pre>
<p>If you are running more then one monit instance on the same
machine, you <strong>must</strong> use separated event queue directories to
avoid sending wrong alerts to the wrong addresses.</p>
<p>If you want to purge the queue by hand (remove queued
event-files), monit should be stopped before the removal.</p>
<p>
</p>
<hr />
<h1><a name="service_timeout">SERVICE TIMEOUT</a></h1>
<p><strong>monit</strong> provides a service timeout mechanism for situations
where a service simply refuses to start or respond over a longer
period. In cases like this, and particularly if monit's poll-cycle
is low, monit will simply increase the machine load by trying to
restart the service.</p>
<p>The timeout mechanism monit provides is based on two variables,
i.e. the number the service has been started and the number of
poll-cycles. For example, if a service had <em>x</em> restarts within
<em>y</em> poll-cycles (where <em>x</em> &lt;= <em>y</em>) then monit will timeout and
not (re)start the service on the next cycle. If a timeout occurs
monit will send you an alert message if you have register
interest for this event.</p>
<p>The syntax for the timeout statement is as follows (keywords
are in capital):</p>
<dl>
<dt><strong><a name="item_cycle">IF NUMBER RESTART NUMBER <code>CYCLE(S)</code> THEN TIMEOUT</a></strong></dt>

</dl>
<p>Where the first number is the number of service restarts and the
second, the number of poll-cycles. If the number of cycles was
reached without a timeout, the service start-counter is reset to
zero. This provides some granularity to catch exceptional cases
and do a service timeout, but let occasional service start and
restarts happen without having an accumulated timeout.</p>
<p>Here is an example where monit will timeout (not check the
service) if the service was restarted 2 times within 3 cycles:</p>
<pre>
 if 2 restarts within 3 cycles then timeout</pre>
<p>To have monit check the service again after a timeout, run 'monit
monitor service' from the command line. This will remove the
timeout lock in the daemon and make the daemon start and check
the service again.</p>
<p>
</p>
<hr />
<h1><a name="service_tests">SERVICE TESTS</a></h1>
<p>Monit provides several tests you may utilize in a service entry
to test a service. Basically here are two classes of tests:
variable and constant object tests.</p>
<p>Constant object tests are related to failed/succeeded state.  In the
case of error, monit will watch whether the failed parameter will
recover - in such case it will handle recovery related
action. General format:</p>
<dl>
<dt><strong><a name="item_if__3ctest_3e__5b_5b_3cx_3e_5d__5btimes_within_5d_">IF &lt;TEST&gt; [[&lt;X&gt;] [TIMES WITHIN] &lt;Y&gt; CYCLES] THEN ACTION
       [ELSE IF SUCCEEDED [[&lt;X&gt;] [TIMES WITHIN] &lt;Y&gt; CYCLES] 
       THEN ACTION]</a></strong></dt>

</dl>
<p>For constant object tests if the &lt;TEST&gt; should validate to true,
then the selected action is executed each cycle the condition
remains true. The value for comparison is constant. Recovery
action is evaluated only once (on failed-&gt;succeeded state change
only). The 'ELSE IF SUCCEEDED' part is optional - if omitted,
monit will do alert action on recovery by default. The alert is
delivered only once on each state change unless overridden by
'reminder' alert option.</p>
<p>Variable object tests begins with 'IF CHANGED' statement and
serves for monitoring of object, which property can change legally
- monit watches whether the value will change again. You can use
it just for alert or to involve some automatic action, as for
example to reload monitored process after its configuration file
was changed.  Variable tests are supported for 'checksum',
'size', 'pid, 'ppid' and 'timestamp' tests only, if you consider
that other tests can be useful in variable form too, please let
us know.</p>
<dl>
<dt><strong><a name="item_if_changed__3ctest_3e__5b_5b_3cx_3e_5d__5btimes_wi">IF CHANGED &lt;TEST&gt; [[&lt;X&gt;] [TIMES WITHIN] &lt;Y&gt; CYCLES] 
       THEN ACTION</a></strong></dt>

</dl>
<p>For variable object tests if the &lt;TEST&gt; should validate to true,
then the selected action is executed once and monit will watch
for another change. The value for comparison is a variable where
the last result becomes the actual value, which is compared in 
future cycles. The alert is delivered each time the condition 
becomes true.</p>
<p>You can restrict the event ratio needed to change the state:</p>
<dl>
<dt><strong><a name="item__2e_2e_2e__5b_5b_3cx_3e_5d__5btimes_within_5d__3cy">... [[&lt;X&gt;] [TIMES WITHIN] &lt;Y&gt; CYCLES] ...</a></strong></dt>

</dl>
<p>This part is optional and is supported by all testing rules.
It defines how many event occurrences during how many cycles
are needed to trigger the following action. You can use it
in several ways - the core syntax is:</p>
<pre>
 [&lt;X&gt;] &lt;Y&gt; CYCLES</pre>
<p>It is possible to use filling words which give the rule better
first-sight sense. You can use any filling words such as: FOR,
TIMES, WITHIN, thus for example:</p>
<pre>
 if failed port 80 for 3 times within 5 cycles then alert</pre>
<p>or</p>
<pre>
 if failed port 80 for 10 cycles then unmonitor</pre>
<p>When you don't specify the &lt;X&gt;, it equals to &lt;Y&gt; by default,
thus the rule applies when &lt;Y&gt; consecutive cycles of inverse
event occurred (relatively to the current service state).</p>
<p>When you omit it at all, monit will by default change state
on first inverse event, which is equivalent to this notation:</p>
<pre>
 1 times within 1 cycles</pre>
<p>It is possible to use this option for failed, succeeded/recovered
or changed rules. More complex examples:</p>
<pre>
 check device rootfs with path /dev/hda1
  if space usage &gt; 80% 5 times within 15 cycles 
     then alert 
     else if succeeded for 10 cycles then alert
  if space usage &gt; 90% for 5 cycles then 
     exec '/try/to/free/the/space'
  if space usage &gt; 99% then exec '/stop/processess'</pre>
<p>Note that the maximal cycles count which can be used in the rule
is limited by the size of 'long long' data type on your platform.
This provides 64 cycles on usual platforms currently. In the case
that you use unsupported value, the configuration parser will
tell you the limits during monit startup.</p>
<p>You must select an action to be executed from this list:</p>
<ul>
<li>
<p><strong>ALERT</strong> sends the user an alert event on each state change (for
constant object tests) or on each change (for variable object
tests).</p>
</li>
<li>
<p><strong>RESTART</strong> restarts the service <em>and</em> sends an alert. Restart is
conducted by first calling the service's registered stop method
and then the service's start method.</p>
</li>
<li>
<p><strong>START</strong> starts the service by calling the service's registered
start method <em>and</em> send an alert.</p>
</li>
<li>
<p><strong>STOP</strong> stops the service by calling the service's registered
stop method <em>and</em> send an alert. If monit stops a service it
will not be checked by monit anymore nor restarted again
later. To reactivate monitoring of the service again you must
explicitly enable monitoring from the web interface or from the
console, e.g. 'monit monitor apache'.</p>
</li>
<li>
<p><strong>EXEC</strong> may be used to execute an arbitrary program <em>and</em> send
an alert. If you choose this action you must state the program to
be executed and if the program require arguments you must enclose
the program and its arguments in a quoted string. You may
optionally specify the uid and gid the executed program should
switch to upon start. For instance:</p>
<pre>
 exec &quot;/usr/local/tomcat/bin/startup.sh&quot;
      as uid nobody and gid nobody</pre>
<p>This may be useful if the program to be started cannot change to
a lesser privileged user and group. This is typically needed for
Java Servers. Remember, if monit is run by the superuser, then
all programs executed by monit will be started with superuser
privileges unless the uid and gid extension was used.</p>
</li>
<li>
<p><strong>MONITOR</strong> will enable monitoring of the service <em>and</em> send
an alert.</p>
</li>
<li>
<p><strong>UNMONITOR</strong> will disable monitoring of the service <em>and</em> send
an alert. The service will not be checked by monit anymore nor
restarted again later.  To reactivate monitoring of the service
you must explicitly enable monitoring from monit's web interface
or from the console using the monitor argument.</p>
</li>
</ul>
<p>
</p>
<h2><a name="resource_testing">RESOURCE TESTING</a></h2>
<p>Monit can examine how much system resources a services are
using. This test may only be used within a system or process
service entry in the monit control file.</p>
<p>Depending on the system or process characteristics, services
can be stopped or restarted and alerts can be generated. Thus
it is possible to utilize systems which are idle and to spare
system under high load.</p>
<p>The full syntax for the resource-statements used for resource
testing is as follows (keywords are in capital and optional
statements in [brackets]),</p>
<dl>
<dt><strong><a name="item_if_resource_operator_value__5b_5b_3cx_3e_5d__3cy_3">IF resource operator value [[&lt;X&gt;] &lt;Y&gt; CYCLES] THEN action
      [ELSE IF SUCCEEDED [[&lt;X&gt;] &lt;Y&gt; CYCLES] THEN action]</a></strong></dt>

</dl>
<p><em>resource</em> is a choice of ``CPU'', ``CPU([user|system|wait])'',
``MEMORY'', ``CHILDREN'', ``TOTALMEMORY'', ``LOADAVG([1min|5min|15min])''.
Some resources can be used inside of system service container,
some in process service container and some in both:</p>
<p>System only resource tests:</p>
<p><code>CPU([user|system|wait])</code> is the percent of time that the system
spend in user  or system/kernel space. Some systems such as linux
2.6 supports 'wait' indicator as well.</p>
<p>Process only resource tests:</p>
<p>CPU is the CPU usage of the process and its children in
parts of hundred (percent).</p>
<p>CHILDREN is the number of child processes of the process.</p>
<p>TOTALMEMORY is the memory usage of the process and its child
processes in either percent or as an amount (Byte, kB, MB, GB).</p>
<p>System and process resource tests:</p>
<p>MEMORY is the memory usage of the system or in the process context
of the process without its child processes in either percent
(of the systems total) or as an amount (Byte, kB, MB, GB).</p>
<p><code>LOADAVG([1min|5min|15min])</code> refers to the system's load average.
The load average is the number of processes in the system run
queue, averaged over the specified time period.</p>
<p><em>operator</em> is a choice of ``&lt;'', ``&gt;'', ``!='', ``=='' in C notation,
``gt'', ``lt'', ``eq'', ``ne'' in shell sh notation and ``greater'',
``less'', ``equal'', ``notequal'' in human readable form (if not
specified, default is EQUAL).</p>
<p><em>value</em> is either an integer or a real number (except for
CHILDREN). For CPU, MEMORY and TOTALMEMORY you need to specify a
<em>unit</em>.  This could be ``%'' or if applicable ``B'' (Byte), ``kB''
(1024 Byte), ``MB'' (1024 KiloByte) or ``GB'' (1024 MegaByte).</p>
<p><em>action</em> is a choice of ``ALERT'', ``RESTART'', ``START'', ``STOP'',
``EXEC'', ``MONITOR'' or ``UNMONITOR''.</p>
<p>To calculate the cycles, a counter is raised whenever the
expression above is true and it is lowered whenever it is false
(but not below 0). All counters are reset in case of a restart.</p>
<p>The following is an example to check that the CPU usage of a
service is not going beyond 50% during five poll cycles. If it
does, monit will restart the service:</p>
<pre>
 if cpu is greater than 50% for 5 cycles then restart</pre>
<p>See also the example section below.</p>
<p>
</p>
<h2><a name="file_checksum_testing">FILE CHECKSUM TESTING</a></h2>
<p>The checksum statement may only be used in a file service
entry. If specified in the control file, monit will compute
a md5 or sha1 checksum for a file.</p>
<p>The checksum test in constant form is used to verify that a
file does not change. Syntax (keywords are in capital):</p>
<dl>
<dt><strong><a name="item_if_failed__5bmd5_7csha1_5d_checksum__5bexpect_chec">IF FAILED [MD5|SHA1] CHECKSUM [EXPECT checksum] 
         [[&lt;X&gt;] &lt;Y&gt; CYCLES] THEN action
      [ELSE IF SUCCEEDED [[&lt;X&gt;] &lt;Y&gt; CYCLES] THEN action]</a></strong></dt>

</dl>
<p>The checksum test in variable form is used to watch for
file changes. Syntax (keywords are in capital):</p>
<dl>
<dt><strong><a name="item_if_changed__5bmd5_7csha1_5d_checksum__5b_5b_3cx_3e">IF CHANGED [MD5|SHA1] CHECKSUM [[&lt;X&gt;] &lt;Y&gt; CYCLES] 
      THEN action</a></strong></dt>

</dl>
<p>The choice of MD5 or SHA1 is optional. MD5 features a 256 bit 
and SHA1 a 320 bit checksum. If this option is omitted monit 
tries to guess the method from the EXPECT string or uses MD5 as
default.</p>
<p><em>expect</em> is optional and if used it specifies a md5 or sha1
string monit should expect when testing a file's checksum. If
<em>expect</em> is used, monit will not compute an initial checksum for
the file, but instead use the string you submit. For example:</p>
<pre>
 if failed checksum and 
    expect the sum 8f7f419955cefa0b33a2ba316cba3659
 then alert</pre>
<p>You can, for example, use the GNU utility <em>md5sum(1)</em> or 
<em>sha1sum(1)</em> to create a checksum string for a file and 
use this string in the expect-statement.</p>
<p><em>action</em> is a choice of ``ALERT'', ``RESTART'', ``START'', ``STOP'',
``EXEC'', ``MONITOR'' or ``UNMONITOR''.</p>
<p>The checksum statement in variable form may be used to check a
file for changes and if changed, do a specified action.  For
instance to reload a server if its configuration file was
changed. The following illustrate this for the apache web server:</p>
<pre>
 check file httpd.conf path /usr/local/apache/conf/httpd.conf
     if changed sha1 checksum 
        then exec &quot;/usr/local/apache/bin/apachectl graceful&quot;</pre>
<p>If you plan to use the checksum statement for security reasons,
(a very good idea, by the way) and to monitor a file or files
which should not change, then please use constant form and also
read the DEPENDENCY TREE section below to see a detailed example
on how to do this properly.</p>
<p>Monit can also test the checksum for files on a remote host via
the HTTP protocol. See the CONNECTION TESTING section below.</p>
<p>
</p>
<h2><a name="timestamp_testing">TIMESTAMP TESTING</a></h2>
<p>The timestamp statement may only be used in a file, fifo or directory
service entry.</p>
<p>The timestamp test in constant form is used to verify various
timestamp conditions. Syntax (keywords are in capital):</p>
<dl>
<dt><strong><a name="item_if_timestamp__5b_5boperator_5d_value__5bunit_5d_5d">IF TIMESTAMP [[operator] value [unit]] [[&lt;X&gt;] &lt;Y&gt; CYCLES] 
      THEN action
      [ELSE IF SUCCEEDED [[&lt;X&gt;] &lt;Y&gt; CYCLES] THEN action]</a></strong></dt>

</dl>
<p>The timestamp statement in variable form is simply to test an
existing file or directory for timestamp changes and if changed,
execute an action. Syntax (keywords are in capital):</p>
<dl>
<dt><strong><a name="item_if_changed_timestamp__5b_5b_3cx_3e_5d__3cy_3e_cycl">IF CHANGED TIMESTAMP [[&lt;X&gt;] &lt;Y&gt; CYCLES] THEN action</a></strong></dt>

</dl>
<p><em>operator</em> is a choice of ``&lt;'', ``&gt;'', ``!='', ``=='' in C notation,
``GT'', ``LT'', ``EQ'', ``NE'' in shell sh notation and ``GREATER'',
``LESS'', ``EQUAL'', ``NOTEQUAL'' in human readable form (if not
specified, default is EQUAL).</p>
<p><em>value</em> is a time watermark.</p>
<p><em>unit</em> is either ``SECOND'', ``MINUTE'', ``HOUR'' or ``DAY'' (it is also
possible to use ``SECONDS'', ``MINUTES'', ``HOURS'', or ``DAYS'').</p>
<p><em>action</em> is a choice of ``ALERT'', ``RESTART'', ``START'', ``STOP'',
``EXEC'', ``MONITOR'' or ``UNMONITOR''.</p>
<p>The variable timestamp statement is useful for checking a file
for changes and then execute an action. This version was written
particularly with configuration files in mind. For instance, if
you monitor the apache web server you can use this statement to
reload apache if the <em>httpd.conf</em> (apache's configuration file)
was changed. Like so:</p>
<pre>
 check file httpd.conf with path /usr/local/apache/conf/httpd.conf
   if changed timestamp
      then exec &quot;/usr/local/apache/bin/apachectl graceful&quot;</pre>
<p>The constant timestamp version is useful for monitoring systems
able to report its state by changing the timestamp of certain
state files. For instance the <em>iPlanet Messaging server stored
process</em> system updates the timestamp of:</p>
<pre>
 o stored.ckp
 o stored.lcu
 o stored.per</pre>
<p>If a task should fail, the system keeps the timestamp. To report
stored problems you can use the following statements:</p>
<pre>
 check file stored.ckp with path /msg-foo/config/stored.ckp
   if timestamp &gt; 1 minute then alert</pre>
<pre>
 check file stored.lcu with path /msg-foo/config/stored.lcu
   if timestamp &gt; 5 minutes then alert</pre>
<pre>
 check file stored.per with path /msg-foo/config/stored.per
   if timestamp &gt; 1 hour then alert</pre>
<p>As mentioned above, you can also use the timestamp statement for
monitoring directories for changes. If files are added or removed
from a directory, its timestamp is changed:</p>
<pre>
 check directory mydir path /foo/directory
  if timestamp &gt; 1 hour then alert</pre>
<p>or</p>
<pre>
 check directory myotherdir path /foo/secure/directory
  if timestamp &lt; 1 hour then alert</pre>
<p>The following example is a hack for restarting a process after a
certain time. Sometimes this is a necessary workaround for some
third-party applications, until the vendor fix a problem:</p>
<pre>
 check file server.pid path /var/run/server.pid
       if timestamp &gt; 7 days 
          then exec &quot;/usr/local/server/restart-server&quot;</pre>
<p>
</p>
<h2><a name="file_size_testing">FILE SIZE TESTING</a></h2>
<p>The size statement may only be used in a file service entry.
If specified in the control file, monit will compute a size
for a file.</p>
<p>The size test in constant form is used to verify various
size conditions. Syntax (keywords are in capital):</p>
<dl>
<dt><strong><a name="item_if_size__5b_5boperator_5d_value__5bunit_5d_5d__5b_">IF SIZE [[operator] value [unit]] [[&lt;X&gt;] &lt;Y&gt; CYCLES] 
      THEN action
      [ELSE IF SUCCEEDED [[&lt;X&gt;] &lt;Y&gt; CYCLES] THEN action]</a></strong></dt>

</dl>
<p>The size statement in variable form is simply to test an existing
file for size changes and if changed, execute an action. Syntax
(keywords are in capital):</p>
<dl>
<dt><strong><a name="item_if_changed_size__5b_5b_3cx_3e_5d__3cy_3e_cycles_5d">IF CHANGED SIZE [[&lt;X&gt;] &lt;Y&gt; CYCLES] THEN action</a></strong></dt>

</dl>
<p><em>operator</em> is a choice of ``&lt;'', ``&gt;'', ``!='', ``=='' in C notation,
``GT'', ``LT'', ``EQ'', ``NE'' in shell sh notation and ``GREATER'',
``LESS'', ``EQUAL'', ``NOTEQUAL'' in human readable form (if not
specified, default is EQUAL).</p>
<p><em>value</em> is a size watermark.</p>
<p><em>unit</em> is a choice of ``B'',``KB'',``MB'',``GB'' or long alternatives
``byte'', ``kilobyte'', ``megabyte'', ``gigabyte''. If it is not
specified, ``byte'' unit is assumed by default.</p>
<p><em>action</em> is a choice of ``ALERT'', ``RESTART'', ``START'', ``STOP'',
``EXEC'', ``MONITOR'' or ``UNMONITOR''.</p>
<p>The variable size test form is useful for checking a file for
changes and send an alert or execute an action. Monit will
register the size of the file at startup and monitor the file for
changes. As soon as the value changed, monit will do specified
action, reset the registered value to new result and continue to
monitor, whether the size changed again.</p>
<p>One example of use for this statement is to conduct security
checks, for instance:</p>
<pre>
 check file su with path /bin/su
       if changed size then exec &quot;/sbin/ifconfig eth0 down&quot;</pre>
<p>which will ``cut the cable'' and stop a possible intruder from
compromising the system further. This test is just one of many
you may use to increase the security awareness on a system. If
you plan to use monit for security reasons we recommend that you
use this test in combination with other supported tests like
checksum, timestamp, and so on.</p>
<p>The constant size test form may be useful in similar or different
contexts. It can, for instance, be used to test if a certain file
size was exceeded and then alert you or monit may execute a
certain action specified by you. An example is to use this
statement to rotate log files after they have reached a certain
size or to check that a database file does not grow beyond a
specified threshold.</p>
<p>To rotate a log file:</p>
<pre>
 check file myapp.log with path /var/log/myapp.log
    if size &gt; 50 MB then 
       exec &quot;/usr/local/bin/rotate /var/log/myapp.log myapp&quot;</pre>
<p>where /usr/local/bin/rotate may be a simple script, such as:</p>
<pre>
 #/bin/bash
 /bin/mv $1 $1.`date +%y-%m-%d`
 /usr/bin/pkill -HUP $2</pre>
<p>Or you may use this statement to trigger the <code>logrotate(8)</code>
program, to do an ``emergency'' rotate. Or to send an alert if a
file becomes a known bottleneck if it grows behind a certain size
because of limits in a database engine:</p>
<pre>
 check file mydb with path /data/mydatabase.db
       if size &gt; 1 GB then alert</pre>
<p>This is a more restrictive form of the first example where the
size is explicitly defined (note that the real su size is system
dependent):</p>
<pre>
 check file su with path /bin/su
       if size != 95564 then exec &quot;/sbin/ifconfig eth0 down&quot;</pre>
<p>
</p>
<h2><a name="file_content_testing">FILE CONTENT TESTING</a></h2>
<p>The match statement allows you to test the content of a text 
file by using regular expressions. This is a great feature if
you need to periodically test files, such as log files, for 
certain patterns. If a pattern match, monit defaults to
raise an alert, other actions are also possible.</p>
<p>The syntax (keywords in capital) for using this function is:</p>
<dl>
<dt><strong><a name="item_if__5bnot_5d_match__7bregex_7cpath_7d__5b_5b_3cx_3">IF [NOT] MATCH {regex|path} [[&lt;X&gt;] &lt;Y&gt; CYCLES] THEN action</a></strong></dt>

</dl>
<p><em>regex</em> is a string containing the extended regular expression.
See also regex(7).</p>
<p><em>path</em> is an absolute path to a file containing extended
regular expression on every line. See also regex(7).</p>
<p><em>action</em> is a choice of ``ALERT'', ``RESTART'', ``START'', ``STOP'',
``EXEC'', ``MONITOR'' or ``UNMONITOR''.</p>
<p>You can use the <em>NOT</em> statement to invert a match.</p>
<p>The content is only being checked every cycle. If content is
being added and removed between two checks they are unnoticed.</p>
<p>On startup the read position is set to the end of the file 
and monit continue to scan to the end of file on each cycle. 
But if the file size should decrease or inode change the read 
position is set to the start of the file.</p>
<p>Only lines ending with a newline character are inspected. Thus,
lines are being ignored until they have been completed with this
character. Also note that only the first 511 characters of a 
line are inspected.</p>
<dl>
<dt><strong><a name="item_ignore__5bnot_5d_match__7bregex_7cpath_7d">IGNORE [NOT] MATCH {regex|path}</a></strong></dt>

</dl>
<p>Lines matching an <em>IGNORE</em> are not inspected during later 
evaluations. <em>IGNORE MATCH</em> has always precedence over 
<em>IF MATCH</em>.</p>
<p>All <em>IGNORE MATCH</em> statements are evaluated first, in the 
order of their appearance. Thereafter, all the <em>IF MATCH</em> 
statements are evaluated.</p>
<p>A real life example might look like this:</p>
<pre>
  check file syslog with path /var/log/syslog
    ignore match 
        &quot;^\w{3} [ :0-9]{11} [._[:alnum:]-]+ monit\[[0-9]+\]:&quot;
    ignore match /etc/monit/ignore.regex
    if match 
        &quot;^\w{3} [ :0-9]{11} [._[:alnum:]-]+ mrcoffee\[[0-9]+\]:&quot;
    if match /etc/monit/active.regex then alert</pre>
<p>
</p>
<h2><a name="filesystem_flags_testing">FILESYSTEM FLAGS TESTING</a></h2>
<p>monit tests the filesystem flags of devices for change. This
test is implicit and monit will send alert in the case of
failure by default.</p>
<p>You may override the default action using below rule (it may only
be used within a device service entry in the monit control file).</p>
<p>This test is useful for detecting changes of the filesystem flags
such as when the filesystem became read-only based on disk errors
or the mount flags were changed (such as nosuid). Each platform
provides different flags set. POSIX defined the RDONLY and NOSUID
flags which should work on all platforms. Some platforms (such as
FreeBSD) present another flags in addition.</p>
<p>The syntax for the fsflags statement is:</p>
<dl>
<dt><strong><a name="item_if_changed_fsflags__5b_5b_3cx_3e_5d__3cy_3e_cycles">IF CHANGED FSFLAGS [[&lt;X&gt;] &lt;Y&gt; CYCLES] THEN action</a></strong></dt>

</dl>
<p><em>action</em> is a choice of ``ALERT'', ``RESTART'', ``START'', ``STOP'',
``EXEC'', ``MONITOR'' or ``UNMONITOR''.</p>
<p>Example:</p>
<pre>
 check device rootfs with path /
       if changed fsflags then exec &quot;/my/script&quot;
       alert root@localhost</pre>
<p>
</p>
<h2><a name="space_testing">SPACE TESTING</a></h2>
<p>Monit can test devices/file systems and check for space
usage. This test may only be used within a device service entry
in the monit control file.</p>
<p>Monit will check a device's total space usage. If you only want
to check available space for non-superuser, you must set the
watermark appropriately (i.e. total space minus reserved blocks
for the superuser).</p>
<p>You can obtain (and set) the superuser's reserved blocks size,
for example by using the tune2fs utility on Linux. On Linux 5% of
available blocks are reserved for the superuser by default. To
list the reserved blocks for the superuser:</p>
<pre>
 [root@berry monit]# tune2fs -l /dev/hda1| grep &quot;Reserved block&quot;
 Reserved block count:     319994
 Reserved blocks uid:      0 (user root)
 Reserved blocks gid:      0 (group root)</pre>
<p>On solaris 10% of the blocks are reserved. You can also use
tunefs on solaris to change values on a live filesystem.</p>
<p>The full syntax for the space statement is:</p>
<dl>
<dt><strong><a name="item_if_space_operator_value_unit__5b_5b_3cx_3e_5d__3cy">IF SPACE operator value unit [[&lt;X&gt;] &lt;Y&gt; CYCLES] THEN action
      [ELSE IF SUCCEEDED [[&lt;X&gt;] &lt;Y&gt; CYCLES] THEN action]</a></strong></dt>

</dl>
<p><em>operator</em> is a choice of ``&lt;'',``&gt;'',``!='',``=='' in c notation, ``gt'',
``lt'', ``eq'', ``ne'' in shell sh notation and ``greater'', ``less'',
``equal'', ``notequal'' in human readable form (if not specified,
default is EQUAL).</p>
<p><em>unit</em> is a choice of ``B'',``KB'',``MB'',``GB'', ``%'' or long
alternatives ``byte'', ``kilobyte'', ``megabyte'', ``gigabyte'',
``percent''.</p>
<p><em>action</em> is a choice of ``ALERT'', ``RESTART'', ``START'', ``STOP'',
``EXEC'', ``MONITOR'' or ``UNMONITOR''.</p>
<p>
</p>
<h2><a name="inode_testing">INODE TESTING</a></h2>
<p>If supported by the file-system, you can use monit to test for
inodes usage. This test may only be used within a device service
entry in the monit control file.</p>
<p>If the device becomes unavailable, monit will call the entry's
registered start method, if it is defined and if monit is running
in active mode. If monit runs in passive mode or the start
methods is not defined, monit will just send an error alert.</p>
<p>The syntax for the inode statement is:</p>
<dl>
<dt><strong><a name="item_inode">IF <code>INODE(S)</code> operator value [unit] [[&lt;X&gt;] &lt;Y&gt; CYCLES] 
      THEN action
      [ELSE IF SUCCEEDED [[&lt;X&gt;] &lt;Y&gt; CYCLES] THEN action]</a></strong></dt>

</dl>
<p><em>operator</em> is a choice of ``&lt;'',``&gt;'',``!='',``=='' in c notation, ``gt'',
``lt'', ``eq'', ``ne'' in shell sh notation and ``greater'', ``less'',
``equal'', ``notequal'' in human readable form (if not specified,
default is EQUAL).</p>
<p><em>unit</em> is optional. If not specified, the value is an absolute
count of inodes. You can use the ``%'' character or the longer
alternative ``percent'' as a unit.</p>
<p><em>action</em> is a choice of ``ALERT'', ``RESTART'', ``START'', ``STOP'',
``EXEC'', ``MONITOR'' or ``UNMONITOR''.</p>
<p>
</p>
<h2><a name="permission_testing">PERMISSION TESTING</a></h2>
<p>Monit can monitor the permissions. This test may only be used
within a file, fifo, directory or device service entry in the
monit control file.</p>
<p>The syntax for the permission statement is:</p>
<dl>
<dt><strong><a name="item_perm">IF FAILED <code>PERM(ISSION)</code> octalnumber [[&lt;X&gt;] &lt;Y&gt; CYCLES] 
      THEN action
      [ELSE IF SUCCEEDED [[&lt;X&gt;] &lt;Y&gt; CYCLES] THEN action]</a></strong></dt>

</dl>
<p><em>octalnumber</em> defines permissions for a file, a directory or a
device as four octal digits (0-7). Valid range: 0000 - 7777 (you
can omit the leading zeros, monit will add the zeros to the left
thus for example ``640'' is valid value and matches ``0640'').</p>
<p><em>action</em> is a choice of ``ALERT'', ``RESTART'', ``START'', ``STOP'',
``EXEC'', ``MONITOR'' or ``UNMONITOR''.</p>
<p>The web interface will show a permission warning if the test
failed.</p>
<p>We recommend that you use the UNMONITOR action in a permission
statement. The rationale for this feature is security and that
monit does not start a possible cracked program or
script. Example:</p>
<pre>
 check file monit.bin with path &quot;/usr/local/bin/monit&quot;
       if failed permission 0555 then unmonitor
       alert foo@bar</pre>
<p>If the test fails, monit will simply send an alert and stop
monitoring the file and propagate an unmonitor action upward in
a depend tree.</p>
<p>
</p>
<h2><a name="uid_testing">UID TESTING</a></h2>
<p>monit can monitor the owner user id (uid). This test may only be
used within a file, fifo, directory or device service entry in
the monit control file.</p>
<p>The syntax for the uid statement is:</p>
<dl>
<dt><strong><a name="item_if_failed_uid_user__5b_5b_3cx_3e_5d__3cy_3e_cycles">IF FAILED UID user [[&lt;X&gt;] &lt;Y&gt; CYCLES] THEN action
      [ELSE IF SUCCEEDED [[&lt;X&gt;] &lt;Y&gt; CYCLES] THEN action]</a></strong></dt>

</dl>
<p><em>user</em> defines a user id either in numeric or in string form.</p>
<p><em>action</em> is a choice of ``ALERT'', ``RESTART'', ``START'', ``STOP'',
``EXEC'', ``MONITOR'' or ``UNMONITOR''.</p>
<p>The web interface will show a uid warning if the test should
fail.</p>
<p>We recommend that you use the UNMONITOR action in a uid
statement. The rationale for this feature is security and that
monit does not start a possible cracked program or
script. Example:</p>
<pre>
 check file passwd with path /etc/passwd
       if failed uid root then unmonitor
       alert root@localhost</pre>
<p>If the test fails, monit will simply send an alert and stop
monitoring the file and propagate an unmonitor action upward in
a depend tree.</p>
<p>
</p>
<h2><a name="gid_testing">GID TESTING</a></h2>
<p>monit can monitor the owner group id (gid). This test may only
be used within a file, fifo, directory or device service entry
in the monit control file.</p>
<p>The syntax for the gid statement is:</p>
<dl>
<dt><strong><a name="item_if_failed_gid_user__5b_5b_3cx_3e_5d__3cy_3e_cycles">IF FAILED GID user [[&lt;X&gt;] &lt;Y&gt; CYCLES] THEN action
      [ELSE IF SUCCEEDED [[&lt;X&gt;] &lt;Y&gt; CYCLES] THEN action]</a></strong></dt>

</dl>
<p><em>user</em> defines a group id either in numeric or in string form.</p>
<p><em>action</em> is a choice of ``ALERT'', ``RESTART'', ``START'', ``STOP'',
``EXEC'', ``MONITOR'' or ``UNMONITOR''.</p>
<p>The web interface will show a gid warning if the test should
fail.</p>
<p>We recommend that you use the UNMONITOR action in a gid
statement. The rationale for this feature is security and that
monit does not start a possible cracked program or
script. Example:</p>
<pre>
 check file shadow with path /etc/shadow
       if failed gid root then unmonitor
       alert root@localhost</pre>
<p>If the test fails, monit will simply send an alert and stop
monitoring the file and propagate an unmonitor action upward in
a depend tree.</p>
<p>
</p>
<h2><a name="pid_testing">PID TESTING</a></h2>
<p>monit tests the process id (pid) of processes for change. This
test is implicit and monit will send alert in the case of failure
by default.</p>
<p>You may override the default action using below rule (it may only
be used within a process service entry in the monit control
file).</p>
<p>The syntax for the pid statement is:</p>
<dl>
<dt><strong><a name="item_if_changed_pid__5b_5b_3cx_3e_5d__3cy_3e_cycles_5d_">IF CHANGED PID [[&lt;X&gt;] &lt;Y&gt; CYCLES] THEN action</a></strong></dt>

</dl>
<p><em>action</em> is a choice of ``ALERT'', ``RESTART'', ``START'', ``STOP'',
``EXEC'', ``MONITOR'' or ``UNMONITOR''.</p>
<p>This test is useful to detect possible process restarts which
has occurred in the timeframe between two monit testing cycles.
In the case that the restart was fast and the process provides
expected service (i.e. all tests succeeded) you will be notified
that the process was replaced.</p>
<p>For example sshd daemon can restart very quickly, thus if someone
changes its configuration and do sshd restart outside of monit
control, you will be notified that the process was replaced by
new instance (or you can optionaly do some other action such as
preventively stop sshd).</p>
<p>Another example is MySQL Cluster which has its own watchdog with
process restart ability. You can use monit for redundant
monitoring. Monit will just send alert in the case that the MySQL
cluster restarted the node quickly.</p>
<p>Example:</p>
<pre>
 check process sshd with pidfile /var/run/sshd.pid
       if changed pid then exec &quot;/my/script&quot;
       alert root@localhost</pre>
<p>
</p>
<h2><a name="ppid_testing">PPID TESTING</a></h2>
<p>monit tests the process parent id (ppid) of processes for change.
This test is implicit and monit will send alert in the case of
failure by default.</p>
<p>You may override the default action using below rule (it may only
be used within a process service entry in the monit control file).</p>
<p>The syntax for the ppid statement is:</p>
<dl>
<dt><strong><a name="item_if_changed_ppid__5b_5b_3cx_3e_5d__3cy_3e_cycles_5d">IF CHANGED PPID [[&lt;X&gt;] &lt;Y&gt; CYCLES] THEN action</a></strong></dt>

</dl>
<p><em>action</em> is a choice of ``ALERT'', ``RESTART'', ``START'', ``STOP'',
``EXEC'', ``MONITOR'' or ``UNMONITOR''.</p>
<p>This test is useful for detecting changes of a process parent.</p>
<p>Example:</p>
<pre>
 check process myproc with pidfile /var/run/myproc.pid
       if changed ppid then exec &quot;/my/script&quot;
       alert root@localhost</pre>
<p>
</p>
<h2><a name="connection_testing">CONNECTION TESTING</a></h2>
<p>Monit is able to perform connection testing via networked ports
or via Unix sockets. A connection test may only be used within a
process or within a host service entry in the monit control file.</p>
<p>If a service listens on one or more sockets, monit can connect to
the port (using either tcp or udp) and verify that the service
will accept a connection and that it is possible to write and
read from the socket. If a connection is not accepted or if there
is a problem with socket read/write, monit will assume that
something is wrong and execute a specified action. If monit is
compiled with openssl, then ssl based network services can also
be tested.</p>
<p>The full syntax for the statement used for connection testing is
as follows (keywords are in capital and optional statements in
[brackets]),</p>
<dl>
<dt><strong><a name="item_if_failed__5bhost_5d_port__5btype_5d__5bprotocol_7">IF FAILED [host] port [type] 
	 [protocol|{send/expect}+] [timeout] [[&lt;X&gt;] &lt;Y&gt; CYCLES]
      THEN action
      [ELSE IF SUCCEEDED [[&lt;X&gt;] &lt;Y&gt; CYCLES] THEN action]</a></strong></dt>

</dl>
<p>or for Unix sockets,</p>
<dl>
<dt><strong><a name="item_if_failed__5bunixsocket_5d__5btype_5d__5bprotocol_">IF FAILED [unixsocket] [type] 
          [protocol|{send/expect}+] [timeout] [[&lt;X&gt;] &lt;Y&gt; CYCLES]
       THEN action
      [ELSE IF SUCCEEDED [[&lt;X&gt;] &lt;Y&gt; CYCLES] THEN action]</a></strong></dt>

</dl>
<p><strong>host:HOST hostname</strong>. Optionally specify the host to connect to.
If the host is not given then localhost is assumed if this test
is used inside a process entry. If this test was used inside a
remote host entry then the entry's remote host is assumed.
Although <em>host</em> is intended for testing name based virtual host
in a HTTP server running on local or remote host, it does allow
the connection statement to be used to test a server running on
another machine. This may be useful; For instance if you use
Apache httpd as a front-end and an application-server as the
back-end running on another machine, this statement may be used
to test that the back-end server is running and if not raise an
alert.</p>
<p><strong>port:PORT number</strong>. The port number to connect to</p>
<p><strong>unixsocket:UNIXSOCKET PATH</strong>. Specifies the path to a Unix
socket. Servers based on Unix sockets, always runs on the local
machine and does not use a port.</p>
<p><strong>type:TYPE {TCP|UDP|TCPSSL}</strong>. Optionally specify the socket type
monit should use when trying to connect to the port. The
different socket types are; TCP, UDP or TCPSSL, where TCP is a
regular stream based socket, UDP is a datagram socket and TCPSSL
specify that monit should use a TCP socket with SSL when
connecting to a port. The default socket type is TCP. If TCPSSL
is used you may optionally specify the SSL/TLS protocol to be
used and the md5 sum of the server's certificate. The TCPSSL
options are:</p>
<pre>
 TCPSSL [SSLAUTO|SSLV2|SSLV3|TLSV1] [CERTMD5 md5sum]</pre>
<p><strong>proto(col):PROTO {protocols}</strong>. Optionally specify the protocol
monit should speak when a connection is established. At the
moment monit knows how to speak:
 <em>APACHE-STATUS</em>
 <em>DNS</em>
 <em>DWP</em>
 <em>FTP</em>
 <em>HTTP</em>
 <em>IMAP</em>
 <em>CLAMAV</em>
 <em>LDAP2</em>
 <em>LDAP3</em>
 <em>MYSQL</em>
 <em>NNTP</em>
 <em>NTP3</em>
 <em>POP</em>
 <em>POSTFIX-POLICY</em>
 <em>RDATE</em>
 <em>RSYNC</em>
 <em>SMTP</em>
 <em>SSH</em>
 <em>TNS</em>
 <em>PGSQL</em>
If you have compiled monit with ssl support, monit can also speak
the SSL variants such as:
 <em>HTTPS</em>
 <em>FTPS</em>
 <em>POPS</em>
 <em>IMAPS</em>
To use the SSL protocol support you need to define the socket as
SSL and use the general protocol name (for example in the case of
HTTPS) :
 TYPE TCPSSL PROTOCOL HTTP
If the server's protocol is not found in this list, simply do not
specify the protocol and monit will utilize a default test,
including testing if it is possible to read and write to the
port. This default test is in most cases more than good enough to
deduce if the server behind the port is up or not.</p>
<p>The protocol statement is:</p>
<pre>
 [PROTO(COL) {name} [REQUEST {&quot;/path&quot;} [with CHECKSUM checksum]]</pre>
<p>As you can see, you may specify a request after the protocol, at
the moment only the HTTP protocol supports the request option.
See also below for an example.</p>
<p>In addition to the standard protocols, the <em>APACHE-STATUS</em>
protocol is a test of a specific server type, rather than a
generic protocol. Server performance is examined using the status
page generated by Apache's mod_status, which is expected to be at
its default address of <a href="http://www.example.com/server-status.">http://www.example.com/server-status.</a>
Currently the <em>APACHE-STATUS</em> protocol examines the percentage
of Apache child processes which are</p>
<pre>
 o logging (loglimit)
 o closing connections (closelimit)
 o performing DNS lookups (dnslimit)
 o in keepalive with a client (keepalivelimit)
 o replying to a client (replylimit)
 o receiving a request (requestlimit)
 o initialising (startlimit)
 o waiting for incoming connections (waitlimit)
 o gracefully closing down (gracefullimit)
 o performing cleanup procedures (cleanuplimit)</pre>
<p>Each of these quantities can be compared against a value relative
to the total number of active Apache child processes. If the
comparison expression is true the chosen action is performed.</p>
<p>The apache-status protocol statement is formally defined as
(keywords in uppercase):</p>
<pre>
 PROTO(COL) {limit} OP PERCENT [OR {limit} OP PERCENT]*</pre>
<p>where {limit} is one or more of: loglimit, closelimit, dnslimit,
keepalivelimit, replylimit, requestlimit, startlimit, waitlimit
gracefullimit or cleanuplimit. The operator OP is one of:
[&lt;|=|&gt;].</p>
<p>You can combine all of these test into one expression or you can
choose to test a certain limit. If you combine the limits you
must or' them together using the OR keyword.</p>
<p>Here's an example were we test for a loglimit more than 10
percent, a dnslimit over 25 percent and a wait limit less than 20
percent of processes. See also more examples below in the example
section.</p>
<pre>
 protocol apache-status 
                loglimit &gt; 10% or
                dnslimit &gt; 50% or
                waitlimit &lt; 20%
 then alert</pre>
<p>Obviously, do not use this test unless the httpd server you are
testing is Apache Httpd and mod_status is activated on the
server.</p>
<p><strong>send/expect: {SEND|EXPECT} ``string'' ...</strong>. If monit does not
support the protocol spoken by the server, you can write your own
protocol-test using <em>send</em> and <em>expect</em> strings. The <em>SEND</em>
statement sends a string to the server port and the <em>EXPECT</em>
statement compares a string read from the server with the string
given in the expect statement. If your system supports POSIX
regular expressions, you can use regular expressions in the
expect string, see <code>regex(7)</code> to learn more about the types of
regular expressions you can use in an expect string. Otherwise
the string is used as it is. The send/expect statement is:</p>
<pre>
 [{SEND|EXPECT} &quot;string&quot;]+</pre>
<p>Note that monit will send a string as it is, and you <strong>must</strong>
remember to include CR and LF in the string sent to the server if
the protocol expect such characters to terminate a string (most
text based protocols used over Internet does). Likewise monit
will read up to 256 bytes from the server and use this string
when comparing the expect string. If the server sends strings
terminated by CRLF, (i.e. ``\r\n'') you <em>may</em> remember to add the
same terminating characters to the string you expect from the
server.</p>
<p>You can use non-printable characters in a send string if 
needed. Use the hex notation, \0xHEXHEX to send any char in the
range \0x00-\0xFF, that is, 0-255 in decimal. This may be useful
when testing some network protocols, particularly those over 
UDP. An example, to test a quake 3 server you can use the 
following,</p>
<pre>
      send &quot;\0xFF\0xFF\0xFF\0xFFgetstatus&quot;
      expect &quot;sv_floodProtect|sv_maxPing&quot;</pre>
<p>Finally, send/expect can be used with any socket type, such as
TCP sockets, UNIX sockets and UDP sockets.</p>
<p><strong>timeout:with TIMEOUT x SECONDS</strong>. Optionally specifies the
connect and read timeout for the connection. If monit cannot
connect to the server within this time it will assume that the
connection failed and execute the specified action. The default
connect timeout is 5 seconds.</p>
<p><em>action</em> is a choice of ``ALERT'', ``RESTART'', ``START'', ``STOP'',
``EXEC'', ``MONITOR'' or ``UNMONITOR''.</p>
<p>
</p>
<h4><a name="connection_testing_using_the_url_notation">Connection testing using the URL notation</a></h4>
<p>You can test a HTTP server using the compact URL syntax. This
test also allow you to use POSIX regular expressions to test the
content returned by the HTTP server.</p>
<p>The full syntax for the URL statement is as follows (keywords are
in capital and optional statements in [brackets]):</p>
<pre>
  IF FAILED URL ULR-spec
     [CONTENT {==|!=} &quot;regular-expression&quot;]
     [TIMEOUT number SECONDS] [[&lt;X&gt;] &lt;Y&gt; CYCLES] 
     THEN action
     [ELSE IF SUCCEEDED [[&lt;X&gt;] &lt;Y&gt; CYCLES] THEN action]</pre>
<p>Where URL-spec is an URL on the standard form as specified in RFC
2396:</p>
<pre>
 &lt;protocol&gt;://&lt;authority&gt;&lt;path&gt;?&lt;query&gt;</pre>
<p>Here is an example on an URL where all components are used:</p>
<pre>
 <a href="http://user:password@www.foo.bar:8080/document/?querystring#ref">http://user:password@www.foo.bar:8080/document/?querystring#ref</a></pre>
<p>If a username and password is included in the URL monit will
attempt to login at the server using <strong>Basic Authentication</strong>.</p>
<p>Testing the content returned by the server is optional. If used,
you can test if the content <strong>match</strong> or does <strong>not match</strong> a
regular expression. Here's an example on how the URL statement
can be used in a <em>check service</em>:</p>
<pre>
 check host FOO with address www.foo.bar
      if failed url 
         <a href="http://user:password@www.foo.bar:8080/?querystring">http://user:password@www.foo.bar:8080/?querystring</a>
         and content == 'action=&quot;j_security_check&quot;'
      then ...</pre>
<p>Monit will look at the content-length header returned by the
server and download this amount before testing the content. That
is, if the content-length is more than 1Mb or this header is not
set by the server monit will default to download up to 1 Mb and
not more.</p>
<p>Only the <code>http(s)</code> protocol is supported in an URL statement. If
the protocol is <strong>https</strong> monit will use SSL when connecting to
the server.</p>
<p>
</p>
<h4><a name="remote_host_ping_test">Remote host ping test</a></h4>
<p>In addition monit can perform ICMP Echo tests in remote host
checks. The icmp test may only be used in a check host entry and
monit must run with super user privileges, that is, the root user
must run monit. The reason is that the icmp test utilize a raw
socket to send the icmp packet and only the super user is allowed
to create a raw socket.</p>
<p>The full syntax for the ICMP Echo statement used for ping testing
is as follows (keywords are in capital and optional statements in
[brackets]):</p>
<pre>
  IF FAILED ICMP TYPE ECHO
     [COUNT number] [WITH] [TIMEOUT number SECONDS] 
       [[&lt;X&gt;] &lt;Y&gt; CYCLES]
     THEN action
     [ELSE IF SUCCEEDED [[&lt;X&gt;] &lt;Y&gt; CYCLES] THEN action]</pre>
<p>The rules for action and timeout are the same as those mentioned
above in the CONNECTION TESTING section. The count parameter
specifies how many consecutive echo requests will be send to the
host in one cycle. In the case that no reply came within timeout
frame, monit reports error. When at least one reply was received,
the test will pass. Monit sends by default three echo requests in
one cycle to prevent the random packet loss from generating false
alarm (i.e. up to 66% packet loss is tolerated). You can set the
count option to a value between 1 and 20, which can serve as an 
error ratio. For example if you require 100% ping success, set 
the count to 1 (i.e. just one request will be sent, and if the
packet was lost an error will be reported).</p>
<p>An icmp ping test is useful for testing if a host is up, before
testing ports at the host. If an icmp ping test is used in a
check host entry, this test is run first and if the ping test
should fail we assume that the connection to the host is down and
monit does <em>not</em> continue to test any ports. Here's an example:</p>
<pre>
 check host xyzzy with address xyzzy.org
       if failed icmp type echo count 5 with timeout 15 seconds 
          then alert
       if failed port 80 proto http then alert
       if failed port 443 type TCPSSL proto http then alert
       alert foo@bar</pre>
<p>In this case, if the icmp test should fail you will get <em>one</em>
alert and only one alert as long as the host is down, and equally
important, monit will <em>not</em> test port 80 and port 443. Likewise
if the icmp ping test should succeed (again) monit will continue
to test both port 80 and 443.</p>
<p>Keep in mind though that some firewalls can block icmp packages
and thus render the test useless.</p>
<p>
</p>
<h4><a name="examples">Examples</a></h4>
<p>To check a port connection and receive an alert if monit cannot
connect to the port, use the following statement:</p>
<pre>
  if failed port 80 then alert</pre>
<p>In this case the machine in question is assumed to be the default
host. For a process entry it's <em>localhost</em> and for a remote host
entry it's the <em>address</em> of the remote host. Monit will conduct
a tcp connection to the host at port 80 and use tcp by default.
If you want to connect with udp, you can specify this after the
port-statement;</p>
<pre>
 if failed port 53 type udp protocol dns then alert</pre>
<p>Monit will stop trying to connect to the port after 5 seconds and
assume that the server behind the port is down. You may increase
or decrease the connect timeout by explicit add a connection
timeout. In the following example the timeout is increased to 15
seconds and if monit cannot connect to the server within 15
seconds the test will fail and an alert message is sent.</p>
<pre>
  if failed port 80 with timeout 15 seconds then alert</pre>
<p>If a server is listening to a Unix socket the following statement
can be used:</p>
<pre>
 if failed unixsocket /var/run/sophie then alert</pre>
<p>A Unix socket is used by some servers for fast (interprocess)
communication on localhost only. A Unix socket is specified by a
path and in the example above the path, /var/run/sophie,
specifies a Unix socket.</p>
<p>If your machine answers for several virtual hosts you can prefix
the port statement with a host-statement like so:</p>
<pre>
 if failed host www.sol.no port 80 then alert
 if failed host 80.69.226.133 port 443 then alert
 if failed host kvasir.sol.no port 80 then alert</pre>
<p>And as mentioned above, if you do not specify a host-statement,
<em>localhost</em> or <em>address</em> is assumed.</p>
<p>Monit also knows how to speak some of the more popular Internet
protocols. So, besides testing for connections, monit can also
speak with the server in question to verify that the server
works. For example, the following is used to test a http server:</p>
<pre>
 if failed host www.tildeslash.com port 80 proto http 
    then restart</pre>
<p>Some protocols also support a request statement. This statement
can be used to ask the server for a special document entity.</p>
<p>Currently <strong>only</strong> the <em>HTTP</em> protocol module supports the
request statement, such as:</p>
<pre>
 if failed host www.myhost.com port 80 protocol http 
    and request &quot;/data/show.php?a=b&amp;c=d&quot;
 then restart</pre>
<p>The request must contain an URI string specifying a document from
the http server. The string will be URL encoded by monit before
it sends the request to the http server, so it's okay to use URL
unsafe characters in the request. If the request statement isn't
specified, the default web server page will be requested.</p>
<p>You can also test the checksum for documents returned by a http
server.  You can use either MD5 sums:</p>
<pre>
 if failed port 80 protocol http 
    and request &quot;/page.html&quot;
        with checksum 8f7f419955cefa0b33a2ba316cba3659 
 then alert</pre>
<p>Or you can use SHA1 sums:</p>
<pre>
 if failed port 80 protocol http 
    and request &quot;/page.html&quot;
        with checksum e428302e260e0832007d82de853aa8edf19cd872 
 then alert</pre>
<p>monit will compute a checksum (either MD5 or SHA1 is used,
depending on length of the hash) for the document (in the above
case, /page.html) and compare the computed checksum with the
expected checksum. If the sums does not match then the if-tests
action is performed, in this case alert. Note that monit will
<strong>not</strong> test the checksum for a document if the server does not
set the HTTP <em>Content-Length</em> header. A HTTP server should set
this header when it server a static document (i.e. a file). A
server will often use chunked transfer encoding instead when
serving dynamic content (e.g. a document created by a CGI-script
or a Servlet), but to test the checksum for dynamic content is
not very useful. There are no limitation on the document size,
but keep in mind that monit will use time to download the
document over the network so it's probably smart not to ask monit
to compute a checksum for documents larger than 1Mb or so,
depending on you network connection of course. Tip; If you get a
checksum error even if the document has the correct sum, the
reason may be that the download timed out. In this case, explicit
set a longer timeout than the default 5 seconds.</p>
<p>As mentioned above, if the server protocol is not supported by
monit you can write your own protocol test using send/expect
strings. Here we show a protocol test using send/expect for an
imaginary ``Ali Baba and the Forty Thieves'' protocol:</p>
<pre>
 if failed host cave.persia.ir port 4040
    send &quot;Open, Sesame!\r\n&quot;
    expect &quot;Please enter the cave\r\n&quot;
    send &quot;Shut, Sesame!\r\n&quot;
    expect &quot;See you later [A-Za-z ]+\r\n&quot;
 then restart</pre>
<p>The <em>TCPSSL</em> statement can optionally test the md5 sum of the
server's certificate. You must state the md5 certificate string
you expect the server to deliver and upon a connect to the
server, the server's actual md5 sum certificate string is tested.
Any other symbol but [A-Fa-f0-9] is being ignored in that sting.
Thus it is possible to copy and paste the output of e.g. openssl.
If they do not match, the connection test fails. If the ssl
version handshake does not work properly you can also force a
specific ssl version, as we demonstrate in this example:</p>
<pre>
 if failed host shop.sol.no port 443 
    type TCPSSL SSLV3 # Force monit to use ssl version 3
    # We expect the server to return this  md5 certificate sum
    # as either 12-34-56-78-90-AB-CD-EF-12-34-56-78-90-AB-CD-EF
    # or e.g.   1234567890ABCDEF1234567890ABCDEF
    # or e.g.   1234567890abcdef1234567890abcdef
    # what ever come in more handy (see text above)
    CERTMD5 12-34-56-78-90-AB-CD-EF-12-34-56-78-90-AB-CD-EF
    protocol http 
 then restart</pre>
<p>Here's an example where a connection test is used inside a
process entry:</p>
<pre>
 check process apache with pidfile /var/run/apache.pid
       start program = &quot;/etc/init.d/httpd start&quot;
       stop program = &quot;/etc/init.d/httpd stop&quot;
       if failed host www.tildeslash.com port 80 then restart</pre>
<p>Here, a connection test is used in a remote host entry:</p>
<pre>
 check host up2date with address ftp.redhat.com
       if failed port 21 and protocol ftp then alert</pre>
<p>Since we did not explicit specify a host in the above test, monit
will connect to port 21 at ftp.redhat.com. Apropos, the host
address can be specified as a dotted IP address string or as
hostname in the DNS. The following is exactly[*] the same test,
but here an ip address is used instead:</p>
<pre>
 check host up2date with address 66.187.232.30
       if failed port 21 and protocol ftp then alert</pre>
<p>[*] Well, not quite, since we specify an ip-address directly we
will bypass any DNS round-robin setup, but that's another story.</p>
<p>For more examples, see the example section below.</p>
<p>
</p>
<hr />
<h1><a name="monit_httpd">MONIT HTTPD</a></h1>
<p>If specified in the control file, monit will start a monit daemon
with http support. From a Browser you can then start and stop
services, disable or enable service monitoring as well as view
the status of each service. Also, if monit logs to its own file,
you can view the content of this logfile in a Browser.</p>
<p>The control file statement for starting a monit daemon with http
support is a global set-statement:</p>
<dl>
<dt><strong><a name="item_set_httpd_port_2812">set httpd port 2812</a></strong></dt>

</dl>
<p>And you can use this URL, <em><a href="http://localhost:2812/">http://localhost:2812/</a></em>, to access
the daemon from a browser. The port number, in this case 2812,
can be any number that you are allowed to bind to.</p>
<p>If you have compiled monit with openssl, you can also start the
httpd server with ssl support, using the following expression:</p>
<pre>
 set httpd port 2812
     ssl enable
     pemfile /etc/certs/monit.pem</pre>
<p>And you can use this URL, <em><a href="https://localhost:2812/">https://localhost:2812/</a></em>, to access
the monit web server over an ssl encrypted connection.</p>
<p>The pemfile, in the example above, holds both the server's
private key and certificate. This file should be stored in a safe
place on the filesystem and should have strict permissions, that
is, no more than 0700.</p>
<p>In addition, if you want to check for client certificates you can
use the CLIENTPEMFILE statement. In this case, a connecting
client has to provided a certificate known by monit in order to
connect. This file also needs to have all necessary CA
certificates. A configuration could look like:</p>
<pre>
 set httpd port 2812
     ssl enable
     pemfile /etc/certs/monit.pem
     clientpemfile /etc/certs/monit-client.pem</pre>
<p>By default self signed client certificates are not allowed. If
you want to use a self signed certificate from a client it has to
be allowed explicitly with the ALLOWSELFCERTIFICATION statement.</p>
<p>For more information on how to use monit with SSL and for more
information about certificates and generating pem files, please
consult the README.SSL file accompanying the software.</p>
<p>If you only want the http server to accept connect requests to
one host addresses you can specify the bind address either as an
IP number string or as a hostname. In the following example we
bind the http server to the loopback device. In other words the
http server will only be reachable from localhost:</p>
<pre>
  set httpd port 2812 and use the address 127.0.0.1</pre>
<p>or</p>
<pre>
  set httpd port 2812 and use the address localhost</pre>
<p>If you do not use the ADDRESS statement the http server will
accept connections on any/all local addresses.</p>
<p>It is possible to hide monit's httpd server version, which 
usually is available in httpd header responses and in error 
pages.</p>
<pre>
  set httpd port 2812
    ...
    signature {enable|disable}</pre>
<p>Use <em>disable</em> to hide the server signature - monit will only
report its name (e.g. 'monit' instead of for example 'monit
4.2'). By default the version signature is enabled. It is worth
to stress that this option provides no security advantage and 
falls into the ``security through obscurity'' category.</p>
<p>If you remove the httpd statement from the config file, monit
will stop the httpd server on configuration reload. Likewise if
you change the port number, monit will restart the http server
using the new specified port number.</p>
<p>The status page displayed by the monit web server is
automatically refreshed with the same poll time set for the monit
daemon.</p>
<p><strong>Note:</strong></p>
<p>We strongly recommend that you start monit with http support (and
bind the server to localhost, only, unless you are behind a
firewall). The built-in web-server is small and does not use much
resources, and more <em>importantly</em>, monit can use the http server
for interprocess communication between a monit client and a monit
daemon.</p>
<p>For instance, you <em>must</em> start a monit daemon with http support
if you want to be able to use most of the available console
commands. I.e. 'monit stop all', 'monit start all' etc.</p>
<p>If a monit daemon is running in the background we will ask the
daemon (via the HTTP protocol) to execute the above commands.
That is, the daemon is requested to start and stop the services.
This ensures that a daemon will not restart a service that you
requested to stop and that (any) timeout lock will be removed
from a service when you start it.</p>
<p>
</p>
<h2><a name="monit_httpd_authentication">Monit HTTPD Authentication</a></h2>
<p>monit supports two types of authentication schema's for
connecting to the httpd server, (three, if you count SSL client
certificate validation). Both schema's can be used together or by
itself. You <strong>must</strong> choose at least one.</p>
<p>
</p>
<h4><a name="host_and_network_allow_list">Host and network allow list</a></h4>
<p>The http server maintains an access-control list of hosts and
networks allowed to connect to the server. You can add as many
hosts as you want to, but only hosts with a valid domain name or
its IP address are allowed. Networks require a network IP and a
netmask to be accepted.</p>
<p>The http server will query a name server to check any hosts
connecting to the server. If a host (client) is trying to connect
to the server, but cannot be found in the access list or cannot
be resolved, the server will shutdown the connection to the
client promptly.</p>
<p>Control file example:</p>
<pre>
  set httpd port 2812
      allow localhost
      allow my.other.work.machine.com
      allow 10.1.1.1
      allow 192.168.1.0/255.255.255.0
      allow 10.0.0.0/8</pre>
<p>Clients, not mentioned in the allow list, trying to connect to
the server are logged with their ip-address.</p>
<p>
</p>
<h4><a name="basic_authentication">Basic Authentication</a></h4>
<p>This authentication schema is HTTP specific and described in more
detail in RFC 2617.</p>
<p>In short; a server challenge a client (e.g. a Browser) to send
authentication information (username and password) and if
accepted, the server will allow the client access to the
requested document.</p>
<p>The biggest weakness with Basic Authentication is that the
username and password is sent in clear-text (i.e. base64 encoded)
over the network. It is therefor recommended that you do not use
this authentication method unless you run the monit http server
with <em>ssl</em> support. With ssl support it is completely safe to
use Basic Authentication since <strong>all</strong> http data, including Basic
Authentication headers will be encrypted.</p>
<p>monit will use Basic Authentication if an allow statement
contains a username and a password separated with a single ':'
character, like so; <em>allow username:password</em>. The username and
password must be written in clear-text.</p>
<p>Alternatively you can use files in ``htpasswd'' format (one
user:passwd entry per line), like so: <em>allow
[cleartext|crypt|md5] /path [users]</em>. By default cleartext
passwords are read. In case the passwords are digested it is
necessary to specify the cryptographic method. If you do not want
all users in the password file to have access to monit you can
specify only those users that should have access, in the allow
statement. Otherwise all users are added.</p>
<p>Example1:</p>
<pre>
  set httpd port 2812
      allow hauk:password
      allow md5 /etc/httpd/htpasswd john paul ringo george</pre>
<p>If you use this method together with a host list, then only
clients from the listed hosts will be allowed to connect to the
monit http server and each client will be asked to provide a
username and a password.</p>
<p>Example2:</p>
<pre>
  set httpd port 2812
      allow localhost
      allow 10.1.1.1
      allow hauk:password</pre>
<p>If you only want to use Basic Authentication, then just provide
allow entries with username and password or password files as in
example 1 above.</p>
<p>Finally it is possible to define some users as read-only. A
read-only user can read the monit web pages but will <em>not</em> get
access to push-buttons and cannot change a service from the web
interface.</p>
<pre>
  set httpd port 2812
      allow admin:password
      allow hauk:password read-only</pre>
<p>A user is set to read-only by using the <em>read-only</em> keyword
<strong>after</strong> username:password. In the above example the user <em>hauk</em>
is defined as a read-only user, while the <em>admin</em> user has all
access rights.</p>
<p>NB! a monit client will use the <em>first</em> username:password pair
in an allow list and you should <strong>not</strong> define the first user as a
read-only user. If you do, monit console commands will not work.</p>
<p>If you use Basic Authentication it is a good idea to set the
access permission for the control file (~/.monitrc) to only
readable and writable for the user running monit, because the
password is written in clear-text. (Use this command, /bin/chmod
600 ~/.monitrc). In fact, since monit <strong>version 3.0</strong>, monit will
complain and exit if the control file is readable by others.</p>
<p>Clients trying to connect to the server but supply the wrong
username and/or password are logged with their ip-address.</p>
<p>If the monit command line interface is being used, at least one
cleartext password is necessary. Otherwise, the monit command
line interface will not be able to connect to the monit daemon
server.</p>
<p>
</p>
<hr />
<h1><a name="dependencies">DEPENDENCIES</a></h1>
<p>If specified in the control file, monit can do dependency
checking before start, stop, monitoring or unmonitoring of
services. The dependency statement may be used within any service
entries in the monit control file.</p>
<p>The syntax for the depend statement is simply:</p>
<dl>
<dt><strong><a name="item_depends_on_service_5b_2c_service__5b_2c_2e_2e_2e_5">DEPENDS on service[, service [,...]]</a></strong></dt>

</dl>
<p>Where <strong>service</strong> is a service entry name, for instance <strong>apache</strong>
or <strong>datafs</strong>.</p>
<p>You may add more than one service name of any type or use more
than one depend statement in an entry.</p>
<p>Services specified in a <em>depend</em> statement will be checked
during stop/start/monitor/unmonitor operations. If a service is
stopped or unmonitored it will stop/unmonitor any services that
depends on itself. Likewise, if a service is started, it will
first stop any services that depends on itself and after it is
started, start all depending services again. If the service is to
be monitored (enable monitoring), all services which this service
depends on will be monitored before enabling monitoring of this
service.</p>
<p>Here is an example where we set up an apache service entry to
depend on the underlying apache binary. If the binary should
change an alert is sent and apache is not monitored anymore. The
rationale is security and that monit should not execute a
possibly cracked apache binary.</p>
<pre>
 (1) check process apache 
 (2)    with pidfile &quot;/usr/local/apache/logs/httpd.pid&quot;
 (3)    ...
 (4)    depends on httpd
 (5)
 (6) check file httpd with path /usr/local/apache/bin/httpd
 (7)    if failed checksum then unmonitor</pre>
<p>The first entry is the process entry for apache shown before
(abbreviated for clarity). The fourth line sets up a dependency
between this entry and the service entry named httpd in line 6. A
depend tree works as follows, if an action is conducted in a
lower branch it will propagate upward in the tree and for every
dependent entry execute the same action. In this case, if the
checksum should fail in line 7 then an unmonitor action is
executed and the apache binary is not checked anymore. But since
the apache process entry depends on the httpd entry this entry
will also execute the unmonitor action. In short, if the checksum
test for the httpd binary file should fail, both the check file
httpd entry and the check process apache entry is set in
un-monitoring mode.</p>
<p>A dependency tree is a general construct and can be used between
all types of service entries and span many levels and propagate
any supported action (except the exec action which will not
propagate upward in a dependency tree for obvious reasons).</p>
<p>Here is another different example. Consider the following common
server setup:</p>
<pre>
  WEB-SERVER -&gt; APPLICATION-SERVER -&gt; DATABASE -&gt; FILESYSTEM
      (a)               (b)             (c)          (d)</pre>
<p>You can set dependencies so that the web-server depends on the
application server to run before the web-server starts and the
application server depends on the database server and the
database depends on the file-system to be mounted before it
starts. See also the example section below for examples using the
depend statement.</p>
<p>Here we describe how monit will function with the above
dependencies:</p>
<dl>
<dt><strong><a name="item_if_no_servers_are_running">If no servers are running</a></strong></dt>

<dd>
<p>monit will start the servers in the following order: <em>d</em>, <em>c</em>,
<em>b</em>, <em>a</em></p>
</dd>
<dt><strong><a name="item_if_all_servers_are_running">If all servers are running</a></strong></dt>

<dd>
<p>When you run 'monit stop all' this is the stop order: <em>a</em>, <em>b</em>,
<em>c</em>, <em>d</em>. If you run 'monit stop d' then <em>a</em>, <em>b</em> and <em>c</em>
are also stopped because they depend on <em>d</em> and finally <em>d</em> is
stopped.</p>
</dd>
<dt><strong><a name="item_if_a_does_not_run">If <em>a</em> does not run</a></strong></dt>

<dd>
<p>When monit runs it will start <em>a</em></p>
</dd>
<dt><strong><a name="item_if_b_does_not_run">If <em>b</em> does not run</a></strong></dt>

<dd>
<p>When monit runs it will first stop <em>a</em> then start <em>b</em> and
finally start <em>a</em> again.</p>
</dd>
<dt><strong><a name="item_if_c_does_not_run">If <em>c</em> does not run</a></strong></dt>

<dd>
<p>When monit runs it will first stop <em>a</em> and <em>b</em> then start <em>c</em>
and finally start <em>b</em> then <em>a</em>.</p>
</dd>
<dt><strong><a name="item_if_d_does_not_run">If <em>d</em> does not run</a></strong></dt>

<dd>
<p>When monit runs it will first stop <em>a</em>, <em>b</em> and <em>c</em> then start
<em>d</em> and finally start <em>c</em>, <em>b</em> then <em>a</em>.</p>
</dd>
<dt><strong><a name="item_if_the_control_file_contains_a_depend_loop_2e">If the control file contains a depend loop.</a></strong></dt>

<dd>
<p>A depend loop is for example; a-&gt;b and b-&gt;a or a-&gt;b-&gt;c-&gt;a.</p>
<p>When monit starts it will check for such loops and complain and
exit if a loop was found. It will also exit with a complaint if a
depend statement was used that does not point to a service in the
control file.</p>
</dd>
</dl>
<p>
</p>
<hr />
<h1><a name="the_run_control_file">THE RUN CONTROL FILE</a></h1>
<p>The preferred way to set up monit is to write a <em>.monitrc</em> file
in your home directory. When there is a conflict between the
command-line arguments and the arguments in this file, the
command-line arguments take precedence. To protect the security
of your control file and passwords the control file must have
permissions <em>no more than 0700</em> (u=xrw,g=,o=); monit will
complain and exit otherwise.</p>
<p>
</p>
<h2><a name="run_control_syntax">Run Control Syntax</a></h2>
<p>Comments begin with a '#' and extend through the end of the line.
Otherwise the file consists of a series of service entries or
global option statements in a free-format, token-oriented syntax.</p>
<p>There are three kinds of tokens: grammar keywords, numbers (i.e.
decimal digit sequences) and strings. Strings can be either
quoted or unquoted. A quoted string is bounded by double quotes
and may contain whitespace (and quoted digits are treated as a
string). An unquoted string is any whitespace-delimited token,
containing characters and/or numbers.</p>
<p>On a semantic level, the control file consists of two types of
entries:</p>
<ol>
<li><strong>Global set-statements</strong>

<p>A global set-statement starts with the keyword <em>set</em> and the
item to configure.</p>
</li>
<li><strong>One or more service entry statements.</strong>

<p>Each service entry consists of the keywords `check', followed by
the service type. Each entry requires a &lt;unique&gt; descriptive
name, which may be freely chosen. This name is used by monit
to refer to the service internally and in all interactions
with the user.</p>
</li>
</ol>
<p>Currently, six types of check statements are supported:</p>
<ol>
<li><strong><a name="item_check_process__3cunique_name_3e_pidfile__3cpath_3e">CHECK PROCESS &lt;unique name&gt; PIDFILE &lt;path&gt;</a></strong>

<p>&lt;path&gt; is the absolute path to the program's pidfile. If the
pidfile does not exist or does not contain the pid number of a
running process, monit will call the entry's start method if
defined, If monit runs in passive mode or the start methods is
not defined, monit will just send alerts on errors.</p>
</li>
<li><strong><a name="item_check_file__3cunique_name_3e_path__3cpath_3e">CHECK FILE &lt;unique name&gt; PATH &lt;path&gt;</a></strong>

<p>&lt;path&gt; is the absolute path to the file. If the file does not
exist or disappeared, monit will call the entry's start method if
defined, if &lt;path&gt; does not point to a regular file type (for
instance a directory), monit will disable monitoring of this
entry. If monit runs in passive mode or the start methods is not
defined, monit will just send alerts on errors.</p>
</li>
<li><strong><a name="item_check_fifo__3cunique_name_3e_path__3cpath_3e">CHECK FIFO &lt;unique name&gt; PATH &lt;path&gt;</a></strong>

<p>&lt;path&gt; is the absolute path to the fifo. If the fifo does not
exist or disappeared, monit will call the entry's start method if
defined, if &lt;path&gt; does not point to a fifo type (for
instance a directory), monit will disable monitoring of this
entry. If monit runs in passive mode or the start methods is not
defined, monit will just send alerts on errors.</p>
</li>
<li><strong><a name="item_check_device__3cunique_name_3e_path__3cpath_3e">CHECK DEVICE &lt;unique name&gt; PATH &lt;path&gt;</a></strong>

<p>&lt;path&gt; is the path to the device block special file, mount point,
file or a directory which is part of a filesystem. It is
recommended to use a block special file directly (for example
/dev/hda1 on Linux or /dev/dsk/c0t0d0s1 on Solaris, etc.) If you
use a mount point (for example /data), be careful, because if the
device is unmounted the test will still be true because the mount
point exist.</p>
<p>If the device becomes unavailable, monit will call the entry's
start method if defined. if &lt;path&gt; does not point to a device,
monit will disable monitoring of this entry. If monit runs in
passive mode or the start methods is not defined, monit will just
send alerts on errors.</p>
</li>
<li><strong><a name="item_check_directory__3cunique_name_3e_path__3cpath_3e">CHECK DIRECTORY &lt;unique name&gt; PATH &lt;path&gt;</a></strong>

<p>&lt;path&gt; is the absolute path to the directory. If the directory
does not exist or disappeared, monit will call the entry's start
method if defined, if &lt;path&gt; does not point to a directory, monit
will disable monitoring of this entry. If monit runs in passive
mode or the start methods is not defined, monit will just send
alerts on errors.</p>
</li>
<li><strong><a name="item_check_host__3cunique_name_3e_address__3chost_addre">CHECK HOST &lt;unique name&gt; ADDRESS &lt;host address&gt;</a></strong>

<p>The host address can be specified as a hostname string or as an
ip-address string on a dotted decimal format. Such as,
tildeslash.com or ``64.87.72.95''.</p>
</li>
<li><strong><a name="item_check_system__3cunique_name_3e">CHECK SYSTEM &lt;unique name&gt;</a></strong>

<p>The system name is usualy hostname, but any descriptive name can be
used. This test allows to check general system resources such as
CPU usage (percent of time spent in user, system and wait), total
memory usage or load average.</p>
</li>
</ol>
<p>You can use noise keywords like 'if', `and', `with(in)', `has',
`using', 'use', 'on(ly)', `usage' and `program(s)' anywhere in an
entry to make it resemble English. They're ignored, but can make
entries much easier to read at a glance. The punctuation
characters ';' ',' and '=' are also ignored. Keywords are case
insensitive.</p>
<pre>
 Here are the legal global keywords:</pre>
<pre>
 Keyword         Function
 ----------------------------------------------------------------
 set daemon      Set a background poll interval in seconds.
 set init        Set monit to run from init. monit will not
                 transform itself into a daemon process.
 set logfile     Name of a file to dump error- and status-
                 messages to. If syslog is specified as the 
                 file, monit will utilize the syslog daemon
                 to log messages. This can optionally be 
                 followed by 'facility &lt;facility&gt;' where 
                 facility is 'log_local0' - 'log_local7' or 
                 'log_daemon'. If no facility is specified, 
                 LOG_USER is used.
 set mailserver  The mailserver used for sending alert
                 notifications. If the mailserver is not 
                 defined, monit will try to use 'localhost' 
                 as the smtp-server for sending mail. You 
                 can add more mail servers, if monit cannot
                 connect to the first server it will try the
                 next server and so on.
 set mail-format Set a global mail format for all alert
                 messages emitted by monit.
 set pidfile     Explicit set the location of the monit lock
                 file. E.g. set pidfile /var/run/xyzmonit.pid.
 set statefile   Explicit set the location of the file monit 
                 will write state data to. If not set, the
                 default is $HOME/.monit.state. 
 set httpd port  Activates monit http server at the given 
                 port number.
 ssl enable      Enables ssl support for the httpd server.
                 Requires the use of the pemfile statement.
 ssl disable     Disables ssl support for the httpd server.
                 It is equal to omitting any ssl statement.
 pemfile         Set the pemfile to be used with ssl.
 clientpemfile   Set the pemfile to be used when client
                 certificates should be checked by monit.
 address         If specified, the http server will only 
                 accept connect requests to this addresses
                 This statement is an optional part of the
                 set httpd statement.
 allow           Specifies a host or IP address allowed to
                 connect to the http server. Can also specify
                 a username and password allowed to connect
                 to the server. More than one allow statement
                 are allowed. This statement is also an 
                 optional part of the set httpd statement.
 read-only       Set the user defined in username:password
                 to read only. A read-only user cannot change
                 a service from the monit web interface.
 include         include a file or files matching the globstring</pre>
<pre>
 Here are the legal service entry keywords:</pre>
<pre>
 Keyword         Function
 ----------------------------------------------------------------
 check           Starts an entry and must be followed by the type
                 of monitored service {device|directory|file|host
                 process|system} and a descriptive name for the
                 service.
 pidfile         Specify the  process pidfile. Every
                 process must create a pidfile with its
                 current process id. This statement should only
                 be used in a process service entry.
 path            Must be followed by a path to the block
                 special file for filesystem (device), regular
                 file, directory or a process's pidfile.
 group           Specify a groupname for a service entry.
 start           The program used to start the specified 
                 service. Full path is required. This 
                 statement is optional, but recommended.
 stop            The program used to stop the specified
                 service. Full path is required. This 
                 statement is optional, but recommended.
 pid and ppid    These keywords may be used as standalone
                 statements in a process service entry to
                 override the alert action for change of
                 process pid and ppid.
 uid and gid     These keywords are either 1) an optional part of
                 a start, stop or exec statement. They may be
                 used to specify a user id and a group id the
                 program (process) should switch to upon start.
                 This feature can only be used if the superuser
                 is running monit. 2) uid and gid may also be
                 used as standalone statements in a file service
                 entry to test a file's uid and gid attributes.
 host            The hostname or IP address to test the port
                 at. This keyword can only be used together
                 with a port statement or in the check host
                 statement.
 port            Specify a TCP/IP service port number which 
                 a process is listening on. This statement
                 is also optional. If this statement is not
                 prefixed with a host-statement, localhost is
                 used as the hostname to test the port at.
 type            Specifies the socket type monit should use when
                 testing a connection to a port. If the type
                 keyword is omitted, tcp is used. This keyword
                 must be followed by either tcp, udp or tcpssl.
 tcp             Specifies that monit should use a TCP 
                 socket type (stream) when testing a port.
 tcpssl          Specifies that monit should use a TCP socket
                 type (stream) and the secure socket layer (ssl)
                 when testing a port connection.
 udp             Specifies that monit should use a UDP socket
                 type (datagram) when testing a port.
 certmd5         The md5 sum of a certificate a ssl forged 
                 server has to deliver.
 proto(col)      This keyword specifies the type of service 
                 found at the port. monit knows at the moment 
                 how to speak HTTP, SMTP, FTP, POP, IMAP, MYSQL,
                 NNTP, SSH, DWP, LDAP2, LDAP3, RDATE, NTP3, DNS,
                 POSTFIX-POLICY, APACHE-STATUS, TNS, PGSQL and 
                 RSYNC.
                 You're welcome to write new protocol test
                 modules. If no protocol is specified monit will
                 use a default test which in most cases are good
                 enough.
 request         Specifies a server request and must come
                 after the protocol keyword mentioned above.
                  - for http it can contain an URL and an
                    optional query string.
                  - other protocols does not support this
                    statement yet
 send/expect     These keywords specify a generic protocol. 
                 Both require a string whether to be sent or
                 to be matched against (as extended regex if 
                 supported).  Send/expect can not be used 
                 together with the proto(col) statement.
 unix(socket)    Specifies a Unix socket file and used like 
                 the port statement above to test a Unix 
                 domain network socket connection.
 URL             Specify an URL string which monit will use for
                 connection testing.
 content         Optional sub-statement for the URL statement.
                 Specifies that monit should test the content
                 returned by the server against a regular 
                 expression.
 timeout x sec.  Define a network port connection timeout. Must
                 be followed by a number in seconds and the 
                 keyword, seconds.
 timeout         Define a service timeout. Must be followed by
                 two digits. The first digit is max number of
                 restarts for the service. The second digit
                 is the cycle interval to test restarts. 
                 This statement is optional.
 alert           Specifies an email address for notification
                 if a service event occurs. Alert can also
                 be postfixed, to only send a message for
                 certain events. See the examples above. More
                 than one alert statement is allowed in an
                 entry. This statement is also optional.
 noalert         Specifies an email address which don't want
                 to receive alerts. This statement is also
                 optional.
 restart, stop   These keywords may be used as actions for 
 unmonitor,      various test statements. The exec statement is
 start and       special in that it requires a following string
 exec            specifying the program to be execute. You may
                 also specify an UID and GID for the exec 
                 statement. The program executed will then run
                 using the specified user id and group id.
 mail-format     Specifies a mail format for an alert message 
                 This statement is an optional part of the
                 alert statement.
 checksum        Specify that monit should compute and monitor a
                 file's md5/sha1 checksum. May only be used in a 
                 check file entry.
 expect          Specifies a md5/sha1 checksum string monit 
                 should expect when testing the checksum. This 
                 statement is an optional part of the checksum 
                 statement.
 timestamp       Specifies an expected timestamp for a file
                 or directory. More than one timestamp statement
                 are allowed. May only be used in a check file or
                 check directory entry.
 changed         Part of a timestamp statement and used as an
                 operator to simply test for a timestamp change.
 every           Validate this entry only at every n poll cycle.
                 Useful in daemon mode when the cycle is short
                 and a service takes some time to start.
 mode            Must be followed either by the keyword active,
                 passive or manual. If active, monit will restart
                 the service if it is not running (this is the
                 default behavior). If passive, monit will not
                 (re)start the service if it is not running - it
                 will only monitor and send alerts (resource
                 related restart and stop options are ignored
                 in this mode also). If manual, monit will enter
                 active mode only if a service was started under
                 monit's control otherwise the service isn't
                 monitored.
 cpu             Must be followed by a compare operator, a number 
                 with &quot;%&quot; and an action. This statement is used
                 to check the cpu usage in percent of a process
                 with its children over a number of cycles. If
                 the compare expression matches then the 
                 specified action is executed.
 mem             The equivalent to the cpu token for memory of a 
                 process (w/o children!).  This token must be 
                 followed by a compare operator a number with 
                 unit {B|KB|MB|GB|%|byte|kilobyte|megabyte|
                 gigabyte|percent} and an action.
 loadavg         Must be followed by [1min,5min,15min] in (), a 
                 compare operator, a number and an action. This
                 statement is used to check the system load 
                 average over a number of cycles. If the compare 
                 expression matches then the specified action is 
                 executed.
 children        This is the number of child processes spawn by a
                 process. The syntax is the same as above.
 totalmem        The equivalent of mem, except totalmem is an
                 aggregation of memory, not only used by a
                 process but also by all its child
                 processes. The syntax is the same as above.
 space           Must be followed by a compare operator, a
                 number, unit {B|KB|MB|GB|%|byte|kilobyte|
                 megabyte|gigabyte|percent} and an action.
 inode(s)        Must be followed by a compare operator, integer
                 number, optionally by percent sign (if not, the
                 limit is absolute) and an action.
 perm(ission)    Must be followed by an octal number describing
                 the permissions.
 size            Must be followed by a compare operator, a
                 number, unit {B|KB|MB|GB|byte|kilobyte|
                 megabyte|gigabyte} and an action.
 depends (on)    Must be followed by the name of a service this
                 service depends on.</pre>
<p>Here's the complete list of reserved <strong>keywords</strong> used by monit:</p>
<p><em>if</em>, <em>then</em>, <em>else</em>, <em>set</em>, <em>daemon</em>, <em>logfile</em>,
<em>syslog</em>, <em>address</em>, <em>httpd</em>, <em>ssl</em>, <em>enable</em>, <em>disable</em>,
<em>pemfile</em>, <em>allow</em>, <em>read-only</em>, <em>check</em>, <em>init</em>, <em>count</em>,
<em>pidfile</em>, <em>statefile</em>, <em>group</em>, <em>start</em>, <em>stop</em>, <em>uid</em>,
<em>gid</em>, <em>connection</em>, <em>port(number)</em>, <em>unix(socket)</em>, <em>type</em>,
<em>proto(col)</em>, <em>tcp</em>, <em>tcpssl</em>, <em>udp</em>, <em>alert</em>, <em>noalert</em>,
<em>mail-format</em>, <em>restart</em>, <em>timeout</em>, <em>checksum</em>, <em>resource</em>,
<em>expect</em>, <em>send</em>, <em>mailserver</em>, <em>every</em>, <em>mode</em>, <em>active</em>,
<em>passive</em>, <em>manual</em>, <em>depends</em>, <em>host</em>, <em>default</em>, <em>http</em>,
<em>ftp</em>, <em>smtp</em>, <em>pop</em>, <em>ntp3</em>, <em>nntp</em>, <em>imap</em>, <em>clamav</em>, 
<em>ssh</em>, <em>dwp</em>, <em>ldap2</em>, <em>ldap3</em>, <em>tns</em>, <em>request</em>, <em>cpu</em>, 
<em>mem</em>, <em>totalmem</em>, <em>children</em>, <em>loadavg</em>, <em>timestamp</em>, 
<em>changed</em>, <em>second(s)</em>, <em>minute(s)</em>, <em>hour(s)</em>, <em>day(s)</em>, 
<em>space</em>, <em>inode</em>, <em>pid</em>, <em>ppid</em>, <em>perm(ission)</em>, <em>icmp</em>,
<em>process</em>, <em>file</em>, <em>directory</em>, <em>device</em>, <em>size</em>, 
<em>unmonitor</em>, <em>rdate</em>, <em>rsync</em>, <em>data</em>, <em>invalid</em>, <em>exec</em>,
<em>nonexist</em>, <em>policy</em>, <em>reminder</em>, <em>instance</em>, <em>eventqueue</em>,
 <em>basedir</em>, <em>slot(s)</em>, <em>system</em> and <em>failed</em></p>
<p>And here is a complete list of <strong>noise keywords</strong> ignored by
monit:</p>
<p><em>is</em>, <em>as</em>, <em>are</em>, <em>on(ly)</em>, <em>with(in)</em>, <em>and</em>, <em>has</em>,
<em>using</em>, <em>use</em>, <em>the</em>, <em>sum</em>, <em>program(s)</em>, <em>than</em>, <em>for</em>,
<em>usage</em>, <em>was</em>, <em>but</em>, <em>of</em>.</p>
<p><strong>Note:</strong> If the <em>start</em> or <em>stop</em> programs are shell scripts,
then the script must begin with <code>#!</code> and the remainder of the
first line must specify an interpreter for the program. E.g.
<code>#!/bin/sh</code></p>
<p>It's possible to write scripts directly into the <em>start</em> and
<em>stop</em> entries by using a string of shell-commands. Like so:</p>
<pre>
 start=&quot;/bin/bash -c 'echo $$ &gt; pidfile; exec program'&quot;
 stop=&quot;/bin/bash -c 'kill -s SIGTERM `cat pidfile`'&quot;</pre>
<p>
</p>
<h2><a name="configuration_examples">CONFIGURATION EXAMPLES</a></h2>
<p>The simplest form is just the check statement. In this example we
check to see if the server is running and log a message if not:</p>
<pre>
 check process resin with pidfile /usr/local/resin/srun.pid</pre>
<p>To have monit start the server if it's not running, add a start
statement:</p>
<pre>
 check process resin with pidfile /usr/local/resin/srun.pid
       start program = &quot;/usr/local/resin/bin/srun.sh start&quot;</pre>
<p>Here's a more advanced example for monitoring an apache
web-server listening on the default port number for HTTP and
HTTPS. In this example monit will restart apache if it's not
accepting connections at the port numbers. The method monit use
for a process restart is to first execute the stop-program, wait
for the process to stop and then execute the start-program. (If
monit was unable to stop or start the service a failed alert
message will be sent if you have requested alert messages to be
sent).</p>
<pre>
 check process apache with pidfile /var/run/httpd.pid
       start program = &quot;/etc/init.d/httpd start&quot;
       stop program  = &quot;/etc/init.d/httpd stop&quot;
       if failed port 80 then restart
       if failed port 443 with timeout 15 seconds then restart</pre>
<p>This example demonstrate how you can run a program as a specified
user (uid) and with a specified group (gid). Many daemon programs
will do the uid and gid switch by them self, but for those
programs that does not (e.g. Java programs), monit's ability to
start a program as a certain user can be very useful. In this
example we start the Tomcat Java Servlet Engine as the standard
<em>nobody</em> user and group. Please note that monit will only switch
uid and gid for a program if the super-user is running monit,
otherwise monit will simply ignore the request to change uid and
gid.</p>
<pre>
 check process tomcat with pidfile /var/run/tomcat.pid
       start program = &quot;/etc/init.d/tomcat start&quot; 
             as uid nobody and gid nobody
       stop program  = &quot;/etc/init.d/tomcat stop&quot;
             # You can also use id numbers instead and write:
             as uid 99 and with gid 99
       if failed port 8080 then alert</pre>
<p>In this example we use udp for connection testing to check if the
name-server is running and also use timeout and alert:</p>
<pre>
 check process named with pidfile /var/run/named.pid
       start program = &quot;/etc/init.d/named start&quot;
       stop program  = &quot;/etc/init.d/named stop&quot;
       if failed port 53 use type udp protocol dns then restart
       if 3 restarts within 5 cycles then timeout</pre>
<p>The following example illustrate how to check if the service
'sophie' is answering connections on its Unix domain socket:</p>
<pre>
 check process sophie with pidfile /var/run/sophie.pid
       start program = &quot;/etc/init.d/sophie start&quot;
       stop  program = &quot;/etc/init.d/sophie stop&quot;
       if failed unix /var/run/sophie then restart</pre>
<p>In this example we check an apache web-server running on
localhost that answers for several IP-based virtual hosts or
vhosts, hence the host statement before port:</p>
<pre>
 check process apache with pidfile /var/run/httpd.pid
       start &quot;/etc/init.d/httpd start&quot;
       stop  &quot;/etc/init.d/httpd stop&quot;
       if failed host www.sol.no port 80 then alert
       if failed host shop.sol.no port 443 then alert
       if failed host chat.sol.no port 80 then alert
       if failed host www.tildeslash.com port 80 then alert</pre>
<p>To make sure that monit is communicating with a http server a
protocol test can be added:</p>
<pre>
 check process apache with pidfile /var/run/httpd.pid
       start &quot;/etc/init.d/httpd start&quot;
       stop  &quot;/etc/init.d/httpd stop&quot;
       if failed host www.sol.no port 80 
          protocol HTTP
          then alert</pre>
<p>This example shows a different way to check a webserver using
the send/expect mechanism:</p>
<pre>
 check process apache with pidfile /var/run/httpd.pid
       start &quot;/etc/init.d/httpd start&quot;
       stop  &quot;/etc/init.d/httpd stop&quot;
       if failed host www.sol.no port 80 
          send &quot;GET / HTTP/1.0\r\nHost: www.sol.no\r\n\r\n&quot;
          expect &quot;HTTP/[0-9\.]{3} 200 .*\r\n&quot;
          then alert</pre>
<p>To make sure that Apache is logging successfully (i.e. no more 
than 60 percent of child servers are logging), use its mod_status
page at www.sol.no/server-status with this special protocol test:</p>
<pre>
 check process apache with pidfile /var/run/httpd.pid
       start &quot;/etc/init.d/httpd start&quot;
       stop  &quot;/etc/init.d/httpd stop&quot;
       if failed host www.sol.no port 80
       protocol apache-status loglimit &gt; 60% then restart</pre>
<p>This configuration can be used to alert you if 25 percent or more
of Apache child processes are stuck performing DNS lookups:</p>
<pre>
 check process apache with pidfile /var/run/httpd.pid
       start &quot;/etc/init.d/httpd start&quot;
       stop  &quot;/etc/init.d/httpd stop&quot;
       if failed host www.sol.no port 80
       protocol apache-status dnslimit &gt; 25% then alert</pre>
<p>Here we use an icmp ping test to check if a remote host is up and
if not send an alert:</p>
<pre>
 check host www.tildeslash.com with address www.tildeslash.com
       if failed icmp type echo count 5 with timeout 15 seconds
          then alert</pre>
<p>In the following example we ask monit to compute and verify the
checksum for the underlying apache binary used by the start and
stop programs. If the the checksum test should fail, monitoring
will be disabled to prevent possibly starting a compromised
binary:</p>
<pre>
 check process apache with pidfile /var/run/httpd.pid
       start program = &quot;/etc/init.d/httpd start&quot;
       stop program  = &quot;/etc/init.d/httpd stop&quot;
       if failed host www.tildeslash.com port 80 then restart
       depends on apache_bin</pre>
<pre>
 check file apache_bin with path /usr/local/apache/bin/httpd
       if failed checksum then unmonitor</pre>
<p>In this example we ask monit to test the checksum for a document
on a remote server. If the checksum was changed we send an alert:</p>
<pre>
 check host tildeslash with address www.tildeslash.com
       if failed port 80 protocol http 
          and request &quot;/monit/dist/monit-4.0.tar.gz&quot;
              with checksum f9d26b8393736b5dfad837bb13780786
       then alert
       alert hauk@tildeslash.com with mail-format {subject: 
         Aaaalarm! }</pre>
<p>Some servers are slow starters, like for example Java based
Application Servers. So if we want to keep the poll-cycle low
(i.e. &lt; 60 seconds) but allow some services to take its time to
start, the <strong>every</strong> statement is handy:</p>
<pre>
 check process dynamo with pidfile /etc/dynamo.pid
       start program = &quot;/etc/init.d/dynamo start&quot;
       stop program  = &quot;/etc/init.d/dynamo stop&quot;
       if failed port 8840 then alert
       every 2 cycles</pre>
<p>Here is an example where we group together two database entries
so you can manage them together, e.g.; 'monit -g database start
all'. The mode statement is also illustrated in the first entry
and have the effect that monit will not try to (re)start this
service if it is not running:</p>
<pre>
 check process sybase with pidfile /var/run/sybase.pid
       start = &quot;/etc/init.d/sybase start&quot;
       stop  = &quot;/etc/init.d/sybase stop&quot;
       mode passive
       group database</pre>
<pre>
 check process oracle with pidfile /var/run/oracle.pid
       start program = &quot;/etc/init.d/oracle start&quot;
       stop program  = &quot;/etc/init.d/oracle stop&quot;
       mode active # Not necessary really, since it's the default
       if failed port 9001 then restart
       group database</pre>
<p>Here is an example to show the usage of the resource checks. It
will send an alert when the CPU usage of the http daemon and its
child processes raises beyond 60% for over two cycles. Apache is
restarted if the CPU usage is over 80% for five cycles or the
memory usage over 100Mb for five cycles or if the machines load
average is more than 10 for 8 cycles:</p>
<pre>
 check process apache with pidfile /var/run/httpd.pid
       start program = &quot;/etc/init.d/httpd start&quot;
       stop program  = &quot;/etc/init.d/httpd stop&quot;
       if cpu &gt; 60% for 2 cycles then alert
       if cpu &gt; 80% for 5 cycles then restart
       if mem &gt; 100 MB for 5 cycles then stop
       if loadavg(5min) greater than 10.0 for 8 cycles then stop</pre>
<p>This examples demonstrate the timestamp statement with exec and
how you may restart apache if its configuration file was
changed.</p>
<pre>
 check file httpd.conf with path /etc/httpd/httpd.conf
       if changed timestamp
          then exec &quot;/etc/init.d/httpd graceful&quot;</pre>
<p>In this example we demonstrate usage of the extended alert
statement and a file check dependency:</p>
<pre>
 check process apache with pidfile /var/run/httpd.pid
      start = &quot;/etc/init.d/httpd start&quot;
      stop  = &quot;/etc/init.d/httpd stop&quot;
      if failed host www.tildeslash.com  port 80 then restart
      alert admin@bar on {nonexist, timeout} 
        with mail-format { 
              from:     bofh@$HOST
              subject:  apache $EVENT - $ACTION
              message:  This event occurred on $HOST at $DATE. 
              Your faithful employee,
              monit
      }
      if 3 restarts within 5 cycles then timeout
      depend httpd_bin
      group apache</pre>
<pre>
 check file httpd_bin with path /usr/local/apache/bin/httpd
       if failed checksum 
          and expect 8f7f419955cefa0b33a2ba316cba3659
              then unmonitor
       if failed permission 755 then unmonitor
       if failed uid root then unmonitor
       if failed gid root then unmonitor
       if changed timestamp then alert
       alert security@bar on {checksum, timestamp, 
                              permission, uid, gid}
             with mail-format {subject: Alaaarrm! on $HOST}
       group apache</pre>
<p>In this example, we demonstrate usage of the depend statement. In
this case, we want to start oracle and apache. However, we've set
up apache to use oracle as a back end, and if oracle is
restarted, apache must be restarted as well.</p>
<pre>
 check process apache with pidfile /var/run/httpd.pid
       start = &quot;/etc/init.d/httpd start&quot;
       stop  = &quot;/etc/init.d/httpd stop&quot;
       depends on oracle</pre>
<pre>
 check process oracle with pidfile /var/run/oracle.pid
       start = &quot;/etc/init.d/oracle start&quot;
       stop  = &quot;/etc/init.d/oracle stop&quot;
       if failed port 9001 then restart</pre>
<p>Next, we have 2 services, oracle-import and oracle-export that
need to be restarted if oracle is restarted, but are independent
of each other.</p>
<pre>
 check process oracle with pidfile /var/run/oracle.pid
       start = &quot;/etc/init.d/oracle start&quot;
       stop  = &quot;/etc/init.d/oracle stop&quot;
       if failed port 9001 then restart</pre>
<pre>
 check process oracle-import 
      with pidfile /var/run/oracle-import.pid
       start = &quot;/etc/init.d/oracle-import start&quot;
       stop  = &quot;/etc/init.d/oracle-import stop&quot;
       depends on oracle</pre>
<pre>
 check process oracle-export 
      with pidfile /var/run/oracle-export.pid
       start = &quot;/etc/init.d/oracle-export start&quot;
       stop  = &quot;/etc/init.d/oracle-export stop&quot;
       depends on oracle</pre>
<p>Finally an example with all statements:</p>
<pre>
 check process apache with pidfile /var/run/httpd.pid
       start program = &quot;/etc/init.d/httpd start&quot;
       stop program  = &quot;/etc/init.d/httpd stop&quot;
       if 3 restarts within 5 cycles then timeout
       if failed host www.sol.no  port 80 protocol http
          and use the request &quot;/login.cgi&quot;
              then alert
       if failed host shop.sol.no port 443 type tcpssl 
          protocol http and with timeout 15 seconds 
              then restart
       if cpu is greater than 60% for 2 cycles then alert
       if cpu &gt; 80% for 5 cycles then restart
       if totalmem &gt; 100 MB then stop
       if children &gt; 200 then alert
       alert bofh@bar with mail-format {from: monit@foo.bar.no}
       every 2 cycles
       mode active
       depends on weblogic
       depends on httpd.pid
       depends on httpd.conf
       depends on httpd_bin
       depends on datafs
       group server</pre>
<pre>
 check file httpd.pid with path /usr/local/apache/logs/httpd.pid
       group server
       if timestamp &gt; 7 days then restart
       every 2 cycles
       alert bofh@bar with mail-format {from: monit@foo.bar.no}
       depends on datafs</pre>
<pre>
 check file httpd.conf with path /etc/httpd/httpd.conf
       group server
       if timestamp was changed 
          then exec &quot;/usr/local/apache/bin/apachectl graceful&quot;
       every 2 cycles
       alert bofh@bar with mail-format {from: monit@foo.bar.no}
       depends on datafs</pre>
<pre>
 check file httpd_bin with path /usr/local/apache/bin/httpd
       group server
       if failed checksum and expect the sum
          8f7f419955cefa0b33a2ba316cba3659 then unmonitor
       if failed permission 755 then unmonitor
       if failed uid root then unmonitor
       if failed gid root then unmonitor
       if changed size then alert
       if changed timestamp then alert
       every 2 cycles
       alert bofh@bar with mail-format {from: monit@foo.bar.no}
       alert foo@bar on { checksum, size, timestamp, uid, gid } 
       depends on datafs</pre>
<pre>
 check device datafs with path /dev/sdb1
       group server
       start program  = &quot;/bin/mount /data&quot;
       stop program  =  &quot;/bin/umount /data&quot;
       if failed permission 660 then unmonitor
       if failed uid root then unmonitor
       if failed gid disk then unmonitor
       if space usage &gt; 80 % then alert
       if space usage &gt; 94 % then stop
       if inode usage &gt; 80 % then alert
       if inode usage &gt; 94 % then stop
       alert root@localhost</pre>
<pre>
 check host ftp.redhat.com with address ftp.redhat.com
       if failed icmp type echo with timeout 15 seconds
          then alert 
       if failed port 21 protocol ftp
          then exec &quot;/usr/X11R6/bin/xmessage -display
                     :0 ftp connection failed&quot;
       alert foo@bar.com
 
 check host www.gnu.org with address www.gnu.org
       if failed port 80 protocol http 
          and request &quot;/pub/gnu/bash/bash-2.05b.tar.gz&quot;
              with checksum 8f7f419955cefa0b33a2ba316cba3659
       then alert
       alert rms@gnu.org with mail-format {
            subject: The gnu server may be hacked again! }</pre>
<p>Note; only the <strong>check type</strong>, <strong>pidfile/path/address</strong> statements
are mandatory, the other statements are optional and the order of
the optional statements is not important.</p>
<p>
</p>
<hr />
<h1><a name="monit_with_heartbeat">MONIT WITH HEARTBEAT</a></h1>
<p>You can download <em>heartbeat</em> from
<a href="http://www.linux-ha.org/download/.">http://www.linux-ha.org/download/.</a> It might be useful to have a
look at The Heartbeat Getting Started Guide at:
<a href="http://www.linux-ha.org/GettingStarted.html">http://www.linux-ha.org/GettingStarted.html</a></p>
<p><strong>Starting up a Node</strong></p>
<p>This is the normal start sequence for a cluster-node. With this
sequence, there should be no error-case, which is not handled
either by heartbeat or by monit. For example, if monit dies,
initd restarts it. If heartbeat dies, monit restarts it. If the
node dies, the heartbeat instance on the other node detects it
and restart the services there.</p>
<ol>
<li><strong><a name="item_initd_starts_monit_with_group_local">initd starts monit with group local</a></strong>

</li>
<li><strong><a name="item_monit_starts_heartbeat_in_local_group">monit starts heartbeat in local group</a></strong>

</li>
<li><strong><a name="item_heartbeat_requests_monit_to_start_the_node_group">heartbeat requests monit to start the node group</a></strong>

</li>
<li><strong><a name="item_monit_starts_the_node_group">monit starts the node group</a></strong>

</li>
</ol>
<p><strong>Monit: <em>/etc/monitrc</em></strong></p>
<p>This example describes a cluster with 2 nodes. Services running
on Node 1 are in the group <em>node1</em> and Node 2 services are in
the <em>node2</em> group.</p>
<p>The local group entries are mode <em>active</em>, the node group
entries are mode <em>manual</em> and controlled by heartbeat.</p>
<pre>
 #
 # local services on both hosts
 #</pre>
<pre>
 check process heartbeat with pidfile /var/run/heartbeat.pid
       start program = &quot;/etc/init.d/heartbeat start&quot;
       stop  program = &quot;/etc/init.d/heartbeat start&quot;
       mode  active
       alert foo@bar
       group local</pre>
<pre>
 check process postfix with pidfile /var/run/postfix/master.pid
       start program = &quot;/etc/init.d/postfix start&quot;
       stop program  = &quot;/etc/init.d/postfix stop&quot;
       mode  active
       alert foo@bar
       group local</pre>
<pre>
 #
 # node1 services
 #</pre>
<pre>
 check process apache with pidfile /var/apache/logs/httpd.pid
       start program = &quot;/etc/init.d/apache start&quot;
       stop program  = &quot;/etc/init.d/apache stop&quot;
       depends named
       alert foo@bar
       mode  manual
       group node1</pre>
<pre>
 check process named with pidfile /var/tmp/named.pid
       start program = &quot;/etc/init.d/named start&quot;
       stop program  = &quot;/etc/init.d/named stop&quot;
       alert foo@bar
       mode  manual
       group node1</pre>
<pre>
 #
 # node2 services
 #</pre>
<pre>
 check process named-slave with pidfile /var/tmp/named-slave.pid
       start program = &quot;/etc/init.d/named-slave start&quot;
       stop program  = &quot;/etc/init.d/named-slave stop&quot;
       mode  manual
       alert foo@bar
       group node2</pre>
<pre>
 check process squid with pidfile /var/squid/logs/squid.pid
       start program = &quot;/etc/init.d/squid start&quot;
       stop program  = &quot;/etc/init.d/squid stop&quot;
       depends named-slave
       alert foo@bar
       mode  manual
       group node2</pre>
<p><strong>initd:  <em>/etc/inittab</em></strong></p>
<p>Monit is started on both nodes with initd. You will need to add
an entry in <em>/etc/inittab</em> to start monit with the same local
group heartbeat is member of.</p>
<pre>
 #/etc/inittab
 mo:2345:respawn:/usr/local/bin/monit -d 10 -c /etc/monitrc -g local</pre>
<p><strong>heartbeat:  <em>/etc/ha.d/haresources</em></strong></p>
<p>When heartbeat starts, heartbeat looks up the node entry and
start the script <em>/etc/init.d/monit-node1</em> or
<em>/etc/init.d/monit-node2</em>. The script calls monit to start the
specific group per node.</p>
<pre>
 # /etc/ha.d/haresources
 node1 IPaddr::172.16.100.1  monit-node1
 node2 IPaddr::172.16.100.2  monit-node2</pre>
<p><strong><em>/etc/init.d/monit-node1</em></strong></p>
<pre>
 #!/bin/bash
 #
 # sample script for starting/stopping all services on node1
 #
 prog=&quot;/usr/local/bin/monit -g node1&quot;
 start()
 {
       echo -n $&quot;Starting $prog:&quot;
       $prog start all
       echo
 }</pre>
<pre>
 stop()
 {
       echo -n $&quot;Stopping $prog:&quot;
       $prog stop all
       echo
 }
 
 case &quot;$1&quot; in
       start)
            start;;
       stop)
            stop;;
       *)
            echo $&quot;Usage: $0 {start|stop}&quot;
            RETVAL=1
 esac
 exit $RETVAL</pre>
<p>
</p>
<h2><a name="handling_state">Handling state</a></h2>
<p>As mentioned elsewhere, monit save its state to a state file. If
the monit process should die, upon restart monit will read its
last known state from this file. This can be a problem if monit
is used in a cluster, as illustrate in this scenario:</p>
<ol>
<li>
<p>The active node fails, the second takes over</p>
</li>
<li>
<p>After a reboot, the failed node comes back, monit read its state
file and start all the services (even manual ones) as they were
running before the failure. This is a problem because services
will now run on both nodes.</p>
</li>
</ol>
<p>The solution to this problem is to remove the monit.state file in
a rc-script called at boot time and before monit is started.</p>
<p>
</p>
<hr />
<h1><a name="files">FILES</a></h1>
<p><em>~/.monitrc</em>  
   Default run control file</p>
<p><em>/etc/monitrc</em>
   If the control file is not found in the default 
   location and /etc contains a <em>monitrc</em> file, this
   file will be used instead.</p>
<p><em>./monitrc</em>  
   If the control file is not found in either of the
   previous two locations, and the current working 
   directory contains a <em>monitrc</em> file, this file is 
   used instead.</p>
<p><em>~/.monitrc.pid</em>
   Lock file to help prevent concurrent runs (non-root
   mode).</p>
<p><em>/var/run/monit.pid</em>
   Lock file to help prevent concurrent runs (root mode,
   Linux systems).</p>
<p><em>/etc/monit.pid</em>
   Lock file to help prevent concurrent runs (root mode,
   systems without /var/run).</p>
<p><em>~/.monit.state</em>  
   monit save its state to this file and utilize 
   information found in this file to recover from 
   a crash. This is a binary file and its content is 
   only of interest to monit. You may set the location
   of this file in the monit control file or by using 
   the -s switch when monit is started.</p>
<p>
</p>
<hr />
<h1><a name="environment">ENVIRONMENT</a></h1>
<p>No environment variables are used by monit. However, when monit
execute a script or a program monit will set several environment
variables which can be utilized by the executable. The following
and <em>only</em> the following environment variables are available:</p>
<dl>
<dt><strong><a name="item_monit_event">MONIT_EVENT</a></strong></dt>

<dd>
<p>The event that occurred on the service</p>
</dd>
<dt><strong><a name="item_monit_service">MONIT_SERVICE</a></strong></dt>

<dd>
<p>The name of the service (from monitrc) on which the event
occurred.</p>
</dd>
<dt><strong><a name="item_monit_date">MONIT_DATE</a></strong></dt>

<dd>
<p>The time and date (rfc 822 style) the event occurred</p>
</dd>
<dt><strong><a name="item_monit_host">MONIT_HOST</a></strong></dt>

<dd>
<p>The host the event occurred on</p>
</dd>
</dl>
<p>The following environment variables are only available for
process service entries:</p>
<dl>
<dt><strong><a name="item_monit_process_pid">MONIT_PROCESS_PID</a></strong></dt>

<dd>
<p>The process pid. This may be 0 if the process was (re)started,</p>
</dd>
<dt><strong><a name="item_monit_process_memory">MONIT_PROCESS_MEMORY</a></strong></dt>

<dd>
<p>Process memory. This may be 0 if the process was (re)started,</p>
</dd>
<dt><strong><a name="item_monit_process_children">MONIT_PROCESS_CHILDREN</a></strong></dt>

<dd>
<p>Process children. This may be 0 if the process was (re)started,</p>
</dd>
<dt><strong><a name="item_monit_process_cpu_percent">MONIT_PROCESS_CPU_PERCENT</a></strong></dt>

<dd>
<p>Process cpu%. This may be 0 if the process was (re)started,</p>
</dd>
</dl>
<p>In addition the following spartan PATH environment variable is
available:</p>
<dl>
<dt><strong><a name="item_path_3d_2fbin_3a_2fusr_2fbin_3a_2fsbin_3a_2fusr_2f">PATH=/bin:/usr/bin:/sbin:/usr/sbin</a></strong></dt>

</dl>
<p>Scripts or programs that depends on other environment variables
or on a more verbose PATH must provide means to set these
variables by them self.</p>
<p>
</p>
<hr />
<h1><a name="signals">SIGNALS</a></h1>
<p>If a monit daemon is running, SIGUSR1 wakes it up from its sleep
phase and forces a poll of all services. SIGTERM and SIGINT will
gracefully terminate a monit daemon. The SIGTERM signal is sent
to a monit daemon if monit is started with the <em>quit</em> action
argument.</p>
<p>Sending a SIGHUP signal to a running monit daemon will force
the daemon to reinitialize itself, specifically it will reread
configuration, close and reopen log files.</p>
<p>Running monit in foreground while a background monit daemon is
running will wake up the daemon.</p>
<p>
</p>
<hr />
<h1><a name="notes">NOTES</a></h1>
<p>This is a very silent program. Use the -v switch if you want to
see what monit is doing, and tail -f the logfile. Optionally for
testing purposes; you can start monit with the -Iv switch. Monit
will then print debug information to the console, to stop monit
in this mode, simply press CTRL^C (i.e. SIGINT) in the same
console.</p>
<p>The syntax (and parser) of the control file is inspired by Eric
S. Raymond et al. excellent fetchmail program. Some portions of
this man page does also receive inspiration from the same
authors.</p>
<p>
</p>
<hr />
<h1><a name="authors">AUTHORS</a></h1>
<p>Jan-Henrik Haukeland &lt;<a href="mailto:hauk@tildeslash.com">hauk@tildeslash.com</a>&gt;, 
Martin Pala &lt;<a href="mailto:martinp@tildeslash.com">martinp@tildeslash.com</a>&gt;, 
Christian Hopp &lt;<a href="mailto:chopp@iei.tu-clausthal.de">chopp@iei.tu-clausthal.de</a>&gt;, 
Rory Toma &lt;<a href="mailto:rory@digeo.com">rory@digeo.com</a>&gt;</p>
<p>See also <a href="http://www.tildeslash.com/monit/who.html">http://www.tildeslash.com/monit/who.html</a></p>
<p>
</p>
<hr />
<h1><a name="copyright">COPYRIGHT</a></h1>
<p>Copyright (C) 2009 by Tildeslash Ltd. All Rights
Reserved. This product is distributed in the hope that it will be
useful, but WITHOUT any warranty; without even the implied
warranty of MERCHANTABILITY or FITNESS for a particular purpose.</p>
<p>
</p>
<hr />
<h1><a name="see_also">SEE ALSO</a></h1>
<p>GNU text utilities; md5sum(1); sha1sum(1); openssl(1); glob(7);
<code>regex(7)</code></p>

<?php include '../include/footer.html'; ?>

