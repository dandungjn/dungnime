<?php 

use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

if (! function_exists('decode_option')) {
    function decode_option($option, $as_array = true)
    {
        return json_decode(option($option, json_encode([])), $as_array);
    }
}

if (! function_exists('format_money')) {
    function format_money($value=0)
    {
        return number_format($value, 0, ',', '.');
    }
}

if (! function_exists('clean_string')) {
    function clean_string($string)
    {
        // Strip HTML Tags
        $clear = strip_tags($string);
        // Clean up things like &amp;
        $clear = html_entity_decode($clear);
        // Strip out any url-encoded stuff
        $clear = urldecode($clear);
        // Replace non-AlNum characters with space
        $clear = preg_replace('/[^A-Za-z0-9]/', ' ', $clear);
        // Replace Multiple spaces with single space
        $clear = preg_replace('/ +/', ' ', $clear);
        // Trim the string of leading/trailing space
        $clear = trim($clear);

        return $clear;
    }
}

if (! function_exists('trim_string')) {
    function trim_string($string, $length = 30, $suffix = '...')
    {
        if (strlen($string) > $length) {

            // truncate string
            $stringCut = substr($string, 0, $length);
            $endPoint = strrpos($stringCut, ' ');

            //if the string doesn't contain any space then it will cut without word basis.
            $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
            $string .= $suffix;
        }
        return $string;
    }
}

if (! function_exists('response_json')) {
    function response_json($success = false, $error = null, $message = '', $data = null, $filter = null)
    {
        $response = [
            'success' => $success,
            'error' => $error,
            'message' => $message
        ];

        if ($data) {
            $response['data'] = $data;
        }
        
        if ($filter) {
            $response['filter'] = $filter;
        }

        return response()->json($response);
    }
}

if (! function_exists('uniqid_real')) {
    function uniqid_real($length = 13) {
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($length / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($length / 2));
        } else {
            throw new \Exception("no cryptographically secure random function available");
        }
        return strtoupper(substr(bin2hex($bytes), 0, $length));
    }
}

if (! function_exists('prepare_main_menu')) {
    function prepare_main_menu() {
        $current_route = explode('.', Route::currentRouteName());
        array_pop($current_route);

        $main_menu = config('core.main_menu');
        $collection = collect($main_menu)->transform(function($item) use ($current_route) {
            if ($item['children']) {
                $item['children'] = collect($item['children'])->transform(function($item) use ($current_route) {
                    $uri = str_replace('.index', '', $item['uri']);
                    $uri = str_replace('.show', '', $uri);
                    $uri = str_replace('.create', '', $uri);
                    $uri = str_replace('.edit', '', $uri);

                    $item['model'] = in_array($uri, $current_route);
                    $item['show'] = (\Auth::user()->is_admin || in_array($item['uri'], \Auth::user()->grup_user ? \Auth::user()->grup_user->hak_akses : []));

                    return $item;
                });

                $uri_child = [];
                foreach ($item['children'] as $key => $value) {
                    array_push($uri_child, $value['uri']);
                }

                if ($uri_child) {
                    $array_uri = [];
                    foreach ($uri_child as $key => $value) {
                        array_push($array_uri, in_array($value , \Auth::user()->grup_user ? \Auth::user()->grup_user->hak_akses : []));
                    }

                    $item['show'] = \Auth::user()->is_admin || in_array($item['show'], $array_uri);
                }
            } else {
                $uri = str_replace('.index', '', $item['uri']);
                $uri = str_replace('.show', '', $uri);
                $uri = str_replace('.create', '', $uri);
                $uri = str_replace('.edit', '', $uri);

                $item['model'] = in_array($uri, $current_route);
                $item['show'] = (\Auth::user()->is_admin || in_array($item['uri'], \Auth::user()->grup_user ? \Auth::user()->grup_user->hak_akses : []));
            }

            $have_true_child = collect($item['children'])->sum(function($item) {
                return $item['model'] ? 1 : 0;
            });

            $item['model'] = $item['model'] ?: ($have_true_child > 0 ? true : false);


            return $item;
        });

        return $collection;
    }
}

if (! function_exists('get_file_url')) {
    function get_file_url($disk_name = 'public', $file_name) {
        if ($file_name) {
            return Storage::disk($disk_name)->url($file_name);
        }

        return $file_name;
    }
}

if (! function_exists('get_access_url')) {
    function get_access_url() {
        \Artisan::call('route:list --json --columns=method,uri,name');
        $routes = json_decode(\Artisan::output(), true);
        $collection = collect($routes);
        
        $routes = $collection->transform(function($item) {
            return collect($item)->only(['method', 'uri', 'name']);
        })
        ->filter(function($item, $key) {
            $available_method = [
                "GET|HEAD", 
                "DELETE"
            ];
            $unavailable_name = [
                "underconstruction", 
                "debugbar", 
                "ignition",
                "frontend",
            ];
            $unavailable_uri = [
                "auth", 
                "fallbackPlaceholder", 
                "table", 
                "/data", 
                "api/", 
                "helper"
            ];

            if (! Str::contains($item['name'], $unavailable_name) &&
                Str::contains($item['method'], $available_method) &&
                !Str::contains($item['uri'], $unavailable_uri) &&
                $item['name']
                ) {
                return $item;
            }
            return;
        })->filter()->values();

        $output = [];
        foreach ($routes as $key => $route) {
            $array_name = explode('.', $route['name']);
            $signed_name = [
                "index", 
                "create",
                "store",
                "show",
                "edit",
                "update",
                "destroy",
                "table",
                "data",
                "helper",
                "import",
            ];

            if (Str::contains($array_name[1], $signed_name)) {
                $menu = Str::title($path = str_replace('-', ' ', $array_name[0]));
            } else {
                $menu = Str::title($path = str_replace('-', ' ', $array_name[1]));
            }
            
            $route['menu'] = $menu;
            $array_name = explode('.', $route['name']);
            if (end($array_name) == 'index') {
                $route['deskripsi'] = 'Tabel ' . Str::title(str_replace('-', ' ', $menu));
            } elseif (end($array_name) == 'create') {
                $route['deskripsi'] = 'Tambah ' . Str::title(str_replace('-', ' ', $menu));
            } elseif (end($array_name) == 'edit') {
                $route['deskripsi'] = 'Ubah ' . Str::title(str_replace('-', ' ', $menu));
            } elseif (end($array_name) == 'show') {
                $route['deskripsi'] = 'Detil ' . Str::title(str_replace('-', ' ', $menu));
            } elseif (end($array_name) == 'destroy') {
                $route['deskripsi'] = 'Hapus ' . Str::title(str_replace('-', ' ', $menu));
            } elseif (end($array_name) == 'import') {
                $route['deskripsi'] = 'Import ' . Str::title(str_replace('-', ' ', $menu));
            } else {
                $route['deskripsi'] = '';
            }
            $output[] = $route;
        }

        \Log::info(collect($output)->groupBy('menu')->toArray());
        return collect($output)->groupBy('menu')->toArray();
    }
}

if (! function_exists('get_file_content')) {
    function get_file_content($disk_name = 'public', $file_name) {
        if ($file_name) {
            return json_decode(Storage::disk($disk_name)->get($file_name), true);
        }

        return $file_name;
    }
}

if (! function_exists('log_activity')) {
    function log_activity($description, $model, $extra = [], $causer = null, $log_name = null) {
        $properties = [];
        if (is_array($model)) {
            foreach ($model as $key => $value) {
                $properties[] = collect([
                                    'attributes' => $value->getOriginal(),
                                    'changes' => $value->getChanges(),
                                ])->merge($extra);
            }
        } else {
            $properties[] = collect([
                                'attributes' => $model->getOriginal(),
                                'changes' => $model->getChanges(),
                            ])->merge($extra);
        }

        activity($log_name ?: config('activitylog.default_log_name', 'default'))
            ->by($causer ?: (Auth::user() ?? null))
            ->withProperties($properties)
            ->log($description);
    }
}
