<?php

use Carbon\Carbon;

if (!function_exists('print_bio')) {
    function print_bio($bio)
    {
        if (empty($bio)) {
            return '';
        }
        
        $bio = nl2br($bio);
        $bio = preg_replace('/\B\@([\w\-]+)/im', '<a href="'.url('/$1').'" class="text-blue-600 dark:text-blue-500">$0</a>', $bio); // RegEx Mention
        
        //$bio = preg_replace("/(?:(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?)/", '<a href="$0" class="text-blue-600 dark:text-blue-500" target="_blank">$0</a>', $bio);
        $bio = preg_replace("/(?:[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?)/", '<a href="https://$0" class="text-blue-600 dark:text-blue-500" target="_blank">$0</a>', $bio); // RegEx URL
        //dd($bio);
        $bio = '<p class="text-sm md:text-xl my-0 py-0">'.$bio.'<p>';
        
        return $bio;
        
    }
}

if (!function_exists('intWithStyle')) {
    function intWithStyle($n)
    {
      if ($n < 1000) return $n;
      $suffix = ['','rb','jt','G','T','P','E','Z','Y'];
      $power = floor(log($n, 1000));
      return round($n/(1000**$power),1,PHP_ROUND_HALF_EVEN).$suffix[$power];
    };
}