<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Fail2BanController extends Controller
{

//sudo visudo
//# Add this line:
//www-data ALL=(ALL) NOPASSWD: /usr/bin/fail2ban-client
//
//shell_exec("sudo fail2ban-client status $jail ...");




    public function index()
    {
        $jails = explode("\n", trim(shell_exec('fail2ban-client status | grep "Jail list" | cut -d ":" -f2')));
        $ips = [];

        foreach ($jails as $jail) {
            $jail = trim($jail);
            if (!$jail) continue;

            $output = shell_exec("fail2ban-client status $jail | grep 'Banned IP list'");
            preg_match('/Banned IP list:\s*(.*)/', $output, $matches);
            $banned = isset($matches[1]) ? preg_split('/\s+/', trim($matches[1])) : [];

            foreach ($banned as $ip) {
                $ips[] = ['ip' => $ip, 'jail' => $jail];
            }
        }

        return view('fail2ban.index', compact('ips'));
    }
}
