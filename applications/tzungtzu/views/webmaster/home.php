<div>
    <!--统计概览-->
    <!-- <div class="totals clearfix">
        <ul>
            <li class="hdli">文档</li>
            <li><a href="info.list.php?info_status=-1">草稿（0）</a></li>
            <li><a href="info.list.php?info_status=3">未通过（0）</a></li>
            <li><a href="info.list.php?info_status=2">审核中（0）</a></li>
            <li><a href="info.list.php?info_status=0">已通过（22）</a></li>
            <li><a href="info.list.php?info_status=1">回收站（0）</a></li>
        </ul>
    </div>
    <p class="line-t-10" style="clear:both;"></p> -->
    <!--当前用户 -->
    <div class="columns-mod l">
        <div class="hd">
            <h5><?php echo $langcu['user_current']?></h5>
        </div>
        <div class="bd">
            <div class="sys-info">
                <table>
                    <tr>
                        <th><?php echo $langcu['user_name']?></th>
                        <td><?php echo $this->tz_user->UName;?></td>
                    </tr>
                    <tr>
                        <th><?php echo $langcu['group_name']?></th>
                        <td><?php echo $this->tz_user->GroupName;?></td>
                    </tr>
                    <tr>
                        <th><?php echo $langcu['operating_system']?> </th>
                        <td><?php echo $operating_system;?></td>
                    </tr>
                    <tr>
                        <th><?php echo $langcu['browser']?></th>
                        <td><?php echo $browser;?></td>
                    </tr>
                    <tr>
                        <th><?php echo $langcu['user_set']?></th>
                        <td><a href="<?php echo base_url('webmaster/accounts/users/edit?id=' . $tz->tz_user->UId);?>" style="color:blue;"><?php echo $langcu['user_set']?></a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <!--产品团队 -->
    <p class="line-t-10" style="clear:both;"></p>
    <div class="columns-mod r">
        <div class="hd">
            <h5><?php echo $langcu['product_team']?></h5>
        </div>
        <div class="bd">
            <div class="sys-info">
                <table>
                    <tr>
                        <th><?php echo $langcu['copyright']?></th>
                        <td id="copyright"><a target="_blank" href="<?php echo WEBSITE;?>" title="<?php echo COMPANY_NAME;?>"><?php echo COMPANY_NAME;?></a></td>
                    </tr>
                    <tr>
                        <th><?php echo $langcu['designer']?></th>
                        <td id="producer"><?php echo DESNGIER;?></td>
                    </tr>
                    <tr>
                        <th><?php echo $langcu['team']?></th>
                        <td id="team"><?php echo TEAM_NAME;?></td>
                    </tr>
                    <tr>
                        <th><?php echo $langcu['website']?></th>
                        <td id="official_website"><a target="_blank" href="<?php echo WEBSITE;?>" title="<?php echo COMPANY_NAME;?>"><?php echo WEBSITE;?></a></td>
                    </tr>
					<tr>
                        <th><?php echo $langcu['email']?></th>
                        <td>&nbsp;</td>
                    </tr>
                    <!-- <tr>
                        <th><?php echo $langcu['qq_contact']?></th>
                        <td id="official_qq">
                            <a target="_blank" href=""><img border="0" title="官方QQ交流群" alt="" src="http://pub.idqqimg.com/wpa/images/group.png">
                            </a>
                        </td>
                    </tr> -->
                </table>
            </div>
        </div>
    </div>
	<p class="line-t-10" style="clear:both;"></p>
	<!--系统信息 -->
    <div class="columns-mod l">
        <div class="hd">
            <h5><?php echo $langcu['system_info']?></h5>
        </div>
        <div class="bd">
            <div class="sys-info">
                <table>
                    <tr>
                        <th><?php echo $langcu['sys_version']?></th>
                        <td><?php echo TZ_VERSION;?></td>
                    </tr>
                    <tr>
                        <th><?php echo $langcu['upload_size']?> </th>
                        <td><?php echo $upload_size;?></td>
                    </tr>
                    <tr>
                        <th><?php echo $langcu['ci_version']?></th>
                        <td><?php echo $ci_version?></td>
                    </tr>
					<tr>
                        <th><?php echo $langcu['php_version']?></th>
                        <td><?php echo $php_version?></td>
                    </tr>
                    <tr>
                        <th><?php echo $langcu['php_work']?></th>
                        <td><?php echo $php_work;?></td>
                    </tr>
					<tr>
                        <th><?php echo $langcu['phpinfo']?></th>
                        <td><a href="<?php echo site_url("{$page_path}/phpinfo")?>"><?php echo $langcu['phpinfo']?></a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
	<!--服务器信息 -->
    <div class="columns-mod r">
        <div class="hd">
            <h5><?php echo $langcu['server_info']?></h5>
        </div>
        <div class="bd">
            <div class="sys-info">
                <table>
                    <tr>
                        <th><?php echo $langcu['server_translate']?></th>
                        <td><?php echo $server_translate;?></td>
                    </tr>
                    <tr>
                        <th><?php echo $langcu['server_language']?></th>
                        <td><?php echo $server_language;?></td>
                    </tr>
                    <tr>
                        <th><?php echo $langcu['server_host']?></th>
                        <td><?php echo $server_host;?></td>
                    </tr>
                    <tr>
                        <th><?php echo $langcu['server_time']?></th>
                        <td><?php echo $server_time?></td>
                    </tr>
                    <tr>
                        <th><?php echo $langcu['database_platform']?></th>
                        <td><?php echo $database_platform;?></td>
                    </tr>
                    <tr>
                        <th><?php echo $langcu['database_version']?></th>
                        <td><?php echo $database_version;?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>   
<p class="line-t-20"></p>