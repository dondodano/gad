<?php
/**
 * Hashing
 */
function encipher($str)
{
    return openssl_encrypt($str,'AES-128-CTR','psms',0, 1234567891011121);
}

function decipher($str)
{
    return openssl_decrypt($str,'AES-128-CTR','psms',0, 1234567891011121);
}

function encode($str, $hasSalt = false)
{
    $salt = randomStr();
    $hash = base64_encode($str);
    if($hasSalt == true)
    {
        return base64_encode( $hash .'?'. $salt );
    }else{
        return base64_encode($hash);
    }
}

function decode($str, $hasSalt = false)
{
    if($hasSalt == true){
        $first_decode = base64_decode($str);
        return base64_decode(explode('?', $first_decode)[0]);
    }else{
        return base64_decode(base64_decode($str));
    }

}

/**
 * Date
 */
function setDate($date, $format = 'Y-m-d'){
    return date($format, strtotime($date));
}

function setToday($format = "Y-m-d")
{
    return now()->format($format);
}

function setTimestamp()
{
    return setDate(setToday(),'Y-m-d H:i:s');
}

/**
 * Currency Format
 */
function currencyFormat($num)
{
    return is_numeric($num) ? number_format($num, 2, '.', ',') : $num;
}

function setCurrency($val){
    if(empty($val) == false){
        if(is_numeric($val))
        {
            return currencyFormat($val);
        }else{
           return $val;
        }
    }else{
        return $val;
    }
}

/**
 * Generate Random String
 */
function randomStr($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 * Session
 */
function sessionSet($key, $val)
{
    if(gettype($key) == 'array')
    {
        if(count((array)$key) > 0)
        {
            foreach($key as $index => $value)
            {
                session([
                    $index => $value
                ]);
            }
        }
    }else{
        session([
            $key =>  $val
        ]);
    }

}

function sessionForget($key)
{
    if(gettype($key) == 'array')
    {
        foreach($key as $each_key)
        {
            session()->forget($each_key);
        }
    }else{
        session()->forget($key);
    }
}

function sessionGet($key)
{
    return session()->get($key);
}

function sessionHas($key)
{
    return session()->has($key);
}

/**
 * Generate Series No
 */
function seriesNo($endnumber, $series = '0000')
{
    $newseries = '';
    if(strlen($endnumber) <= strlen($series)){
        $newseries = substr($series, 0, (strlen($series) - strlen($endnumber)) ) . $endnumber;
    }else{
        $diff = (strlen($endnumber) - strlen($series));
        for($i=0; $i<=$diff; $i++){
            $series .= '0';
        }
        $newseries = substr($series, 0, (strlen($series) - strlen($endnumber)) ) . $endnumber;
    }
    return $newseries;
}

/**
 * Concatination
 */
function concat($separator, $array)
{
    $string = '';

    $subIndex =  $separator != null || strlen($separator) > 0 ? 1: 0;

    if(gettype($array) === 'array')
    {
        foreach($array as $item)
        {
            $string .= $item . $separator;
        }
    }
	$string = substr($string, 0, (strlen($string) - $subIndex));
    return $string;
}

/**
 * Convert to String
 */
function toStr($string)
{
    if(gettype($string) == 'integer')
    {
        return empty($string) == false ? strval($string) : "0";
    }else if(gettype($string) == 'double')
    {
        return empty($string) == false ? strval($string) : "0.00";
    }

}

/**
 * File
 */
/**
 * Depreciated
 */
function getFile($fileName, $appendBasePath = false, $fileFor = null)
{
    $fileLocation = null;
    $isDeployed = (bool)config('app.app_deployed');
    $dir_array = ['avatar', 'backups', 'database', 'images', 'favicon', 'attachment'];

    $basePath = public_path();
    $path = public_path('storage/');

    $statePath = '/storage';
    if($fileFor != null && $fileFor == 'report')
    {
        $statePath = 'storage';
    }

    if($isDeployed == true)
    {
        $statePath = 'public/storage';
    }

    /*$basePath = storage_path();
    $path = storage_path('app/public/');
    $statePath = 'storage/app/public';
    */

    if(strlen($fileName) > 0)
    {
        if(is_dir($path))
        {
            $dirContents = scandir($path);
            foreach($dirContents as $dir)
            {
                if(in_array($dir, $dir_array))
                {
                    foreach(scandir($path . $dir) as $file )
                    {
                        if(!is_dir($file))
                        {
                            $temp = concat('/',[ $path, $dir, $file]);
                            if(file_exists($temp))
                            {
                                if($fileName == $file)
                                {
                                    $fileLocation = concat('/', [$statePath , $dir , $fileName]);
                                    break;
                                }
                            }else{
                                $fileLocation =  concat('/', [$statePath , $dir , 'default_logo.png']);
                            }


                        }
                    }
                }
            }
        }else{
            $fileLocation =  '/storage/images/default_logo.png';
        }
    }else{
        $fileLocation = '/storage/images/default_logo.png';
    }

    $tempFile = ($appendBasePath == true ? $basePath : '') .  $fileLocation;
    if(strlen($tempFile) == 0 )
    {
        $tempFile =  '/storage/source/default_logo.png';
    }

    return  $tempFile;
}

function getFileName($fileName)
{
    return pathinfo($fileName)['filename'];
}

function getFileSize($bytes)
{
    if ($bytes >= 1073741824)
    {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    }
    elseif ($bytes >= 1048576)
    {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    }
    elseif ($bytes >= 1024)
    {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    }
    elseif ($bytes > 1)
    {
        $bytes = $bytes . ' bytes';
    }
    elseif ($bytes == 1)
    {
        $bytes = $bytes . ' byte';
    }
    else
    {
        $bytes = '0 bytes';
    }

    return $bytes;
}

function getFileExtension($fileName)
{
    return pathinfo($fileName)['extension'];
}

function removeFileExtension($filename)
{
   return preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
}

/**
 * Shorten String
 */
function shorten($str, $limit = 30)
{
    $string = strip_tags($str);
    if (strlen($string) > $limit) {

        $stringCut = substr($string, 0, $limit);
        $endPoint = strrpos($stringCut, ' ');

        $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
        $string .= '...';
    }
    return $string;
}


/**
 * Show Elapse Time
 */
function elapse($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full)
    {
        $string = array_slice($string, 0, 1);
    }
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}


/**
 * JSON Reponse : JSON encode and decoded
 */
function jsonResponse($data)
{
    return json_decode(json_encode($data));
}


/**
 * Maintenance
 */
function setMaintenance()
{
    $path = storage_path('framework/') .'poop';
    writeFile($path,'true');
}

function isMaintenance()
{
    $bool = false;
    if(file_exists( storage_path('framework/') . 'poop'))
    {
        $bool = true;
    }
    return $bool;
}

function liftMaintenance()
{
    $path = storage_path('framework/') . 'poop';
    if(file_exists($path ))
    {
        unlink($path);
    }
}

/**
 * Write File
 */
function writeFile($filePath, $contents)
{
    try{

        $file = fopen($filePath, "w");
        fwrite($file, $contents );
        fclose($file);

    }catch(Exception $e)
    {
        report($e);
    }

}

/**
 * URL Segment
 */
function urlSegment()
{
    return array_reverse((array)explode('/', strtolower(getSegmentsURL())));
}

function getSegmentsURL()
{
    $set_url = "";
    $limiter = 3;
    $newstring = "";

    if (count(request()->segments()) > 0 ){
        for ($i=count(request()->segments()); $i>=0;$i--){
            $set_url .= Str::upper(request()->segment($i)) . "/";
        }

        $set_url = substr($set_url,0, strlen($set_url)-2);
        $newstring = $set_url;
    }
    return $newstring;
}

/**
 * URL Case
 */
function urlCase($url)
{
    if(strlen($url) <= 3)
    {
        return strtoupper($url);
    }else{
        return ucfirst(strtolower($url));
    }
}

/**
 * Check if base64
 */
function isBase64($s)
{
    // Check if there are valid base64 characters
    if (!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $s)) return false;

    // Decode the string in strict mode and check the results
    $decoded = base64_decode($s, true);
    if(false === $decoded) return false;

    // Encode the string again
    if(base64_encode($decoded) != $s) return false;

    return true;
}

/**
 * Sidebar Active
 */
function activeSide($current)
{
    if(gettype($current) == 'array')
    {
        foreach($current as $each)
        {
            if(in_array($each,request()->segments()) ){
                return ' active';
            }
        }
    }else{
        if(in_array($current,request()->segments()) ){
            return ' active';
        }
    }
}

/**
 * Sidebar Open Side
 */
function openSide($menu)
{
    foreach($menu as $each)
    {
        if(in_array($each,request()->segments()) ){
            return 'active open';
        }
    }
}

/**
 * Get Setting
 */
function getSetting($key)
{
    $keyValue= '';
    $settings = App\Models\Setting\Setting::all();
    foreach($settings as $setting)
    {
        if(strtolower($setting->key) == strtolower($key))
        {
            $keyValue = $setting->value;
        }
    }
    return $keyValue;
}

/**
 * Get Fav ICON
 */
function getFavIcon()
{
    $fav = '';

    try{
        $fav = App\Models\Setting\Setting::where('key', 'FAV_ICO')->first()->value;
    }catch(Exeception $e)
    {
        $fav = 'default_logo.png';
    }

    return $fav;
}

/**
 * Move File
 */
function moveFile($filename)
{
    $file_path = public_path() .'/'. $filename;
    if(file_exists($file_path))
    {
        copy( $file_path, public_path() . '/storage/backups/' . $filename);
        unlink($file_path);
    }
}

/**
 * Get Backup Files
 */
function getBackupFiles($fileExtension = 'zip')
{
    $files = [];
    $scan_files = scandir(public_path() . '/storage/backups/');
    foreach($scan_files as $file)
    {
        if(!is_dir($file))
        {
            $get = pathinfo($file);
            if($get["extension"] == $fileExtension)
            {
                array_push($files, [
                    'filename' => $file,
                    'location' => public_path() . '/storage/backups/' . $file
                ]);
            }
        }
    }
    return $files;
}


/**
 * Get  & Interpret Rating Value of Training
 */
function getRatingValue($json, $keyValue)
{
    $value = null;
    foreach(json_decode($json) as $rating)
    {
        if($rating->index == $keyValue)
        {
            $value = $rating->rate;
            break;
        }
    }
    return $value;
}

/**
 * Allowed URL
 */
function allow_url()
{
    $bool = false;
    /*$only_exemption_menu = [
        'institute', 'program', 'faculty', 'user', 'setting', 'log-user', 'log-activity', 'backup-system', 'backup-database', 'maintenance'
    ];*/

    $only_accessible_menu = [
        'research', 'publication', 'extension', 'training', 'partnership','presentation',
    ];


    $extra_menu = [
        'dashboard', 'logout','signout', 'logout', 'my'
    ];

    $only_accessible_menu = array_merge($only_accessible_menu, $extra_menu);


    $urlsegment = urlSegment();

    if(session()->has('USER_ROLE_ID'))
    {
        if(in_array(sessionGet('USER_ROLE_ID'), [ 1 ])) // 1 = SUPER USER , 2 = Faculty, 3 = Staff
        {
            $bool = true;
        }else{
            if(count($urlsegment) == 0)
            {
                // Validate allowed Menu
                if(in_array($urlsegment, $only_accessible_menu))
                {
                    $bool = true;
                }
            }else{
                // Validate allowed Menu
                if(in_array($urlsegment[0], $only_accessible_menu))
                {
                    $bool = true;
                }
            }
        }
    }

    return $bool;
}

/**
 * User Privileged Menu
 */
function user_privileged_menu()
{
    $bool = false;
    if(in_array(sessionGet('USER_ROLE_ID'), [ 1 ]) )
    {
        $bool = true;
    }
    return $bool;
}

/**
 * Store Activity Log
 */
function logUserActivity($request, $activity)
{
    $activitylog = App\Models\Log\LogUserActivity::create([
        'user_id' => sessionGet('id'),
        'ip_address' => $request->ip(),
        'agent' => $request->header('User-Agent'),
        'activity' => $activity
    ]);
    $activitylog->save();
}



/**
 * Check Role :::: Depreciated
 */
function is_super()
{
    if(sessionGet('role_id') == 1)
    {
        return true;
    }
    return false;
}

function is_admin()
{
    if(sessionGet('role_id') == 2)
    {
        return true;
    }
    return false;
}

function is_faculty()
{
    if(sessionGet('role_id') == 3)
    {
        return true;
    }
    return false;
}

function is_staff()
{
    if(sessionGet('role_id') == 4)
    {
        return true;
    }
    return false;
}

/**
 * Blade Diviser
 */
function blade_divider($center = '<i class="bx bx-caret-down-circle"></i>')
{
    return '
    <div class="divider">
        <div class="divider-text">
            '.$center.'
        </div>
    </div>';
}


/**
 * Sum Up
 */
function sumUp($value, $increment)
{
    return $value + $increment;
}

function sumGender($preliminary)
{
    $female = empty($preliminary->worksheet) ? '0' : $preliminary->worksheet->female;
    $male = empty($preliminary->worksheet) ? '0' : $preliminary->worksheet->male;
    return $female + $male;
}

/**
 * Start Setup
 */
function isSetup()
{
    $bool = false;
    $root = config('app.app_deployed') == true ? dirname(dirname(dirname(dirname(__FILE__)))) :  dirname(dirname(dirname(__FILE__)));
    if(file_exists($root . '/setup.php'))
    {
        $bool = true;
    }
    return $bool;
}

/**
 * Tokenized
 */
function token()
{
    return time() . date('Ymdhis');
}

/**
 * Name
 */
function initialName()
{
    $name = (array)sessionGet('name_array');

    $firstName = isset($name['firstname']) ? $name['firstname'][0] : 'Temp';
    $middleName = isset($name['middlename']) ? (strlen($name['middlename']) > 1 ? $name['middlename'][0].'. ' :  '') : '';
    $lastName = isset($name['lastname']) ? $name['lastname'] : 'Name';

    return $firstName . '. '.$middleName.' '. $lastName;
}

/**
 * Get First Letter
 */
function getFirstLettersOfName($firstname, $lastname)
{
    return strtoupper($firstname[0] . $lastname[0]);
}

/**
 * Middle Initial of Name
 */
function getMiddleInitial($middlename)
{
    return strlen($middlename) > 0 ? strtoupper($middlename[0]).'.' : "";
}

/**
 * User Full Name
 */
function fullName()
{
    $name = (array)sessionGet('name_array');

    return ucwords(
        concat(' ',[
            $name['firstname'],
            strlen($name['middlename']) > 1 ? $name['middlename'][0].'.' : "",
            $name['lastname']
        ])
    );
}

/**
 * Background Switch
 */
function bgSwitch($prefix = 'bg-label')
{
    $min = 0;
    $max = 6;
    $index = rand($min,$max);

    $color = [
        'primary',
        'secondary',
        'success',
        'danger',
        'warning',
        'info',
        'dark',
    ];

    return concat('-',[
        $prefix,
        $color[$index]
    ]);
}




/**
 * Active Status Icon & Text
 */
function statusIcon($index)
{
    return $index == 1 ? 'bx-check-shield text-success' : 'bx-shield-x text-danger';
}

function statusText($index)
{
    return $index == 1 ? 'Active' : 'Inactive';
}

/**
 * Dropdown Status Action
 */
// function statusActionControl($id , $index, $root = 'user')
// {
//     $control = '
//         <a href="/'.$root.'/'.'status/'.$id.'/active" class="dropdown-item">
//             <i class="bx bx-check-shield" ></i> Active
//         </a>
//         <div class="dropdown-divider"></div>
//         <a href="#" class="dropdown-item  disabled">
//             <i class="bx bx-shield-x"></i> Deactive
//         </a>
//     ';

//     if($index == 1)
//     {
//         $control = '
//             <a href="#" class="dropdown-item disabled">
//                 <i class="bx bx-check-shield" ></i> Active
//             </a>
//             <div class="dropdown-divider"></div>
//             <a href="'.$root.'/'.'status/'.$id.'/deactive" class="dropdown-item">
//                 <i class="bx bx-shield-x"></i> Deactive
//             </a>
//         ';
//     }

//     return '<div class="dropdown-menu dropdown-menu-end m-0" style="">'.$control.'</div>';
// }

// function statusActionControlV2($id , $index, $root = 'user')
// {
//     $control = '
//         <a href="/'.$root.'/'.'status/'.$id.'/active" class="dropdown-item">
//             <i class="bx bx-check-circle"></i> Active
//         </a>
//         <div class="dropdown-divider"></div>
//         <a href="#" class="dropdown-item  disabled">
//             <i class="bx bx-x-circle"></i> Deactive
//         </a>
//     ';

//     if($index == 1)
//     {
//         $control = '
//             <a href="#" class="dropdown-item disabled">
//                 <i class="bx bx-check-circle" ></i> Active
//             </a>
//             <div class="dropdown-divider"></div>
//             <a href="'.$root.'/'.'status/'.$id.'/deactive" class="dropdown-item">
//                 <i class="bx bx-x-circle"></i> Deactive
//             </a>
//         ';
//     }

//     return '<div class="dropdown-menu dropdown-menu-end m-0" style="">'.$control.'</div>';
// }

/**
 * Dropdown View and Download
 */
// function repositoryActionControl( $file, $root = 'user')
// {
//     $control = '
//         <a href="/'.$root.'/'.'preview/'.$file.'" class="dropdown-item">
//             <i class="bx bx-spreadsheet"></i> Preview
//         </a>
//         <div class="dropdown-divider"></div>
//         <a href="/'.$root.'/'.'download/'.$file.'" class="dropdown-item">
//             <i class="bx bx-download"></i> Download
//         </a>
//     ';


//     return '<div class="dropdown-menu dropdown-menu-end m-0" style="">'.$control.'</div>';
// }

// function repositoryActionControlV2( $id, $root = 'user')
// {

//     $downloadId = "'".encipher($id)."'";

//     $control = '
//         <a href="/'.$root.'/'.'preview/'.$id.'" class="dropdown-item">
//             <i class="bx bx-spreadsheet"></i> Preview
//         </a>
//         <div class="dropdown-divider"></div>
//         <button type="button" class="dropdown-item" wire:click="download('.$downloadId.')">
//             <i class="bx bx-download"></i> Download
//         </button>
//     ';


//     return '<div class="dropdown-menu dropdown-menu-end m-0" style="">'.$control.'</div>';
// }

function repositoryDropdown( $source, $root = 'user')
{

    $repositoryId = "'".encipher($source->id)."'";

    $edit = '
        <a href="/research/edit/'.$source->id.'"  class="dropdown-item">
            <i class="bx bx-edit"></i> Edit
        </a>
        <div class="dropdown-divider"></div>';

    $viewAndDownload = '
        <a href="/'.$root.'/'.'preview/'.$source->id.'" class="dropdown-item">
            <i class="bx bx-info-circle" ></i> View details
        </a>
        <button type="button" class="dropdown-item" wire:click="download('.$repositoryId.')">
            <i class="bx bx-download"></i> Download
        </button>';

    $delete = '
        <div type="button" class="dropdown-divider"></div>
        <button class="dropdown-item" title="Delete" wire:click="remove('.$repositoryId.')">
            <i class="bx bx-trash"></i> Delete
        </button>
    ';


    return '<div class="dropdown-menu dropdown-menu-end m-0" style="">'.concat('',[
        ( $source->owner == sessionGet('id') ? $edit : ''),
        $viewAndDownload,
        ( $source->owner == sessionGet('id') ? $delete : '')
    ]).'</div>';
}

function requisiteLivewireControl($source,$root = 'user')
{

    $newId = "'".encipher($source->id)."'";

    $activeStatus = $source->status == 1 ? 'disabled' : null;
    $deactiveStatus = $source->status == 1 ? null : 'disabled';


    $control = concat('',[
        '<button class="dropdown-item '.$activeStatus.'" wire:click.prevent="active('.$newId.')">
            <i class="bx bx-check-circle"></i> Active
        </button>',
        '<div class="dropdown-divider"></div>',
        '<button class="dropdown-item '.$deactiveStatus.'" wire:click.prevent="deactive('.$newId.')">
            <i class="bx bx-x-circle"></i> Deactive
        </button>'
    ]);

    return '<div class="dropdown-menu dropdown-menu-end m-0" style="">'.$control.'</div>';
}

function userLivewireControl($source, $root = 'user')
{
    $newId = "'".encipher($source->id)."'";

    $activeStatus = $source->status == 1 ? 'disabled' : null;
    $deactiveStatus = $source->status == 1 ? null : 'disabled';


    $control = concat('',[
        '<button class="dropdown-item '.$activeStatus.'" wire:click.prevent="active('.$newId.')">
            <i class="bx bx-check-shield"></i> Active
        </button>',
        '<div class="dropdown-divider"></div>',
        '<button class="dropdown-item '.$deactiveStatus.'" wire:click.prevent="deactive('.$newId.')">
        <i class="bx bx-shield-x"></i> Deactive
        </button>'
    ]);

    return '<div class="dropdown-menu dropdown-menu-end m-0" style="">'.$control.'</div>';
}

/**
 * String Invalidate Null
 */
function inValidateNull($value)
{
    return $value == null ? "" : $value;
}

/**
 * String Partial Value to Intenger
 */
function partialIntValue($value, $partialValue = 1)
{
    return is_string($value) == true ? $partialValue : $value;
}


/**
 * Temporary Avatar
 */
function avatar($size = "")
{
    $avatar = sessionGet('avatar');
    if(strlen($avatar) > 0 || $avatar != null)
    {
        return '<img src="'.getFileShortLocation($avatar).'" alt="Avatar" width="96"  />';
    }

    $temp_avatar = sessionGet('temp_avatar');
    if(strlen($temp_avatar) > 0 || $temp_avatar != null)
    {
        return avatarWrapper($temp_avatar, $size);
    }

    $firstName = isset(sessionGet('name_array')['firstname']) ? sessionGet('name_array')['firstname'] : 'Temp';
    $lastName = isset(sessionGet('name_array')['lastname']) ? sessionGet('name_array')['lastname'] : 'Name';

    return avatarWrapper('<span class="avatar-initial rounded-circle '.bgSwitch().'">'.getFirstLettersOfName( $firstName, $lastName).'</span>', $size);
}

function avatarWrapper($content , $size = "")
{
    return concat('',[
        '<div class="avatar-wrapper">',
        '<div class="avatar '.$size.' me-3">',
        $content,
        '</div>',
        '</div>'
    ]);
}


/**
 * Status Options
 */
function badgeBg($index, $array_of_values)
{
    /*$index = 0;
    $array_of_values = [ 5 => 'bg-label-danger',6 => 'bg-label-success' ];*/

    foreach($array_of_values as $key => $value)
    {
      if($index == $key)
      {
          return $value;
      }
    }
}

function recordIndicator($index, $array_of_values)
{

    foreach($array_of_values as $key => $value)
    {
      if($index == $key)
      {
          return $value;
      }
    }
}


function avatarWrapperBg($userTempAvatar)
{
    return !empty($userTempAvatar) ? $userTempAvatar : bgSwitch();
}



/**
 * Empty Row
 */

function emptyEndRow($colSpan = 6)
{
    return concat("",[
            '<tr>',
            '<td valign="top" colspan="'.$colSpan.'" class="text-center bg-light">No data available in table</td>',
            '</tr>'
            ]);
}


/**
 * File location
 */
function getFileFullLocation($fileName)
{
    return realpath(public_path() . '/storage'. '/'.  $fileName);
}

function getFileShortLocation($fileName)
{   if(file_exists(realpath(public_path() . '/storage'. '/'.  $fileName)))
    {
        return '/storage'. '/'.  $fileName;
    }
    return '/storage/images/default_logo.png';
}

/**
 * Avatar Online Status
 */
function isOnline($userId)
{
    return Cache::get('user-' . $userId)['isOnline'] ==1;
}

/**
 * User Cache Time
 */
function isOnlineTime($userId)
{
    return Cache::get('user-' . $userId)['time'];
}


/**
 * Online User Count
 */
function onlineUserCountText($array)
{
    return concat(' ',[
        count($array),
        count($array) > 0 ? 'online' : 'onlines'
    ]);
}


/**
 * Notification Avatar
 */
function notificationAvatar(){
    $avatar = sessionGet('avatar');
    $temp_avatar = sessionGet('temp_avatar');

    if(strlen($avatar) == 0 || $avatar == null)
    {
        return $tem_avatar;
    }
    return '<img src="'.$avatar.'" alt="Avatar" class="w-px-40 h-auto rounded-circle">';
}


/**
 * Custom Basename
 */
function basenameV2($str){
    $regex = strpos($str,'\\');
    if($regex)
    {
        $replaced = str_replace('\\', '/', $str);
        $extract = explode('/', $replaced);
        return $extract[count($extract)-1];
    }else{
        return $str;
    }

}

/**
 * Get Quarter
 */
function getQuarter($perMonths = 3)
{
    return ceil(date('m', time()) / $perMonths);
}

/**
 * Session Current Quarter and Year
 */
function getQuarterSuffix()
{
    return [
        '1' => 'st',
        '2' => 'nd',
        '3' => 'rd',
        '4' => 'th'
    ];
}

function getCurrentQuarter()
{
    // Suffix
    $suffix = getQuarterSuffix();

     // Cache
     $currentQuarter = getQuarter();
     if(cache()->has('current-quarter-'.auth()->user()->id))
     {
         return [
            'value' => cache()->get('current-quarter-'.auth()->user()->id)['value'],
            'suffix' => cache()->get('current-quarter-'.auth()->user()->id)['suffix'],
         ];

     }

     return [
        'value' => $currentQuarter,
        'suffix' => $suffix[$currentQuarter]
     ];
}

function getCurrentYear()
{
    if(cache()->has('current-year-'.auth()->user()->id))
    {
        return [
            'value' => cache()->get('current-year-'.auth()->user()->id)['value']
        ];
    }

    return [
        'value' => setToday('Y')
    ];
}

function setDisableQuarter($quarter)
{
    if($quarter == getCurrentQuarter()['value'])
    {
        return ' disabled ';
    }
}

function setDisableRCenter($rcenterid)
{
    if($rcenterid == sessionGet('responsibility_center')['id'])
    {
        return ' disabled';
    }
}

/**
 * Super and Admin
 */
function isRoleNotAdmin($roles = ['super', 'admin']){
    if(!in_array(strtolower(sessionGet('role')), $roles))
    {
        return true;
    }
    return false;
}

function isRoleBelongsTo($roles = ['super', 'admin']){
    if(in_array(strtolower(sessionGet('role')), $roles))
    {
        return true;
    }
    return false;
}


/**
 * Login and Forgot-Password and Reset-Password
 */
function appFavIcon()
{
    $webIcon = 'images/default_logo';

    if(cache()->get('webicon'))
    {
        $webIcon =cache()->get('webicon')['path'];
    }

    return getFileShortLocation($webIcon);
}


/**
 * Check URL if Local
 */
function isDeployedLocal()
{
    $file = storage_path('framework/') . 'production';
    if(file_exists($file))
    {
        $content = file_get_contents($file);

        if(config('app.url') == 'http://127.0.0.1:8000' && filter_var($content, FILTER_VALIDATE_BOOLEAN) == true
            || str_contains(config('app.url'), 'http://127.0.0.1:8000')  && filter_var($content, FILTER_VALIDATE_BOOLEAN) == true)
        {
            return true;
        }
    }
    return false;
}

function isUrlLocal()
{
    if(config('app.url') == 'http://127.0.0.1:8000' || str_contains(config('app.url'), 'http://127.0.0.1:8000'))
    {
        return true;
    }
    return false;
}
