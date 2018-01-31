<?php
namespace App\Helpers;

use Aws\S3\Exception\S3Exception;
use Image;
use Illuminate\Contracts\Filesystem\Filesystem;

class Helper
{
    public static function s3_url_gen($location)
    {
        return 'https://s3-ap-southeast-1.amazonaws.com/taviyani/'.$location;
    }
    
    public static function local_url_gen($location)
    {
        return '/'.'image/'.$location;
    }

    public static function slug_gen($str)
    {
        $str = strtolower(trim($str));
        $str = preg_replace('/[^a-z0-9-]/', '-', $str);
        $str = preg_replace('/-+/', "-", $str);
        return $str;
    }

    public static function un_slug_gen($str)
    {
        $str = ucfirst(trim($str));
        $str = str_replace("-", " ", $str);
        return $str;
    }

    public static function photo_upload_original_s3($file, $fileName, $location) {
        $s3 = \Storage::disk(env('UPLOAD_TYPE', 's3'));
        $upload_location = $location."/original"."/".$fileName;
        //Original Image Resize
        $original = Image::make($file)->resize(1080, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });        
        //Upload original
        try {
            $s3->put($upload_location, $original->stream()->__toString(), 'public');
        } 
        catch (S3Exception $e) {
            return var_dump($e);
        }

        return $upload_location;

    }

    public static function photo_upload_thumbnail_s3($file, $fileName, $location) {
        $s3 = \Storage::disk(env('UPLOAD_TYPE', 's3'));
        $upload_location = $location."/thumbnail"."/".$fileName;

        //Thumbnail image Resize
        $thumbnail = Image::make($file)->resize(null, 200, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        //Upload thumbnail
        try {
            $s3->put($upload_location, $thumbnail->stream()->__toString(), 'public');
        } 
        catch (S3Exception $e) {
            return var_dump($e);
        }

        return $upload_location;
    }        

    public static function delete_image_s3($location) {
        $s3 = \Storage::disk(env('UPLOAD_TYPE', 's3'));

        if($s3->exists($location)) {
            $s3->delete($location);
        }
        return;
    }

    public static function split_string_by_slash($input_array) {
        $seperated = [];
        foreach ($input_array as $number) {
            $splited = preg_split("#/#", $number);
            $seperated[] = $splited[0];
            $seperated[] = $splited[1];
        }
    
        return $seperated;
    }

    public static function remove_all_space_in_string ($input_array) {
        // Remove Space
        $pattern = '/\s*/m';
        $replace = '';
        $space_removed = [];
        foreach ($input_array as $key => $number) {
            if (preg_match('/\s*/m', $number)) {
                $spaceRemoved = preg_replace($pattern, $replace, $number);
                $space_removed[] = $spaceRemoved;
            } else {
                $space_removed[] = $number;
            }

        }

        $space_removed = array_values($space_removed);

        return $space_removed;
    }

    public static function check_for_duplicates (array $input_array) {
        return count($input_array) === count(array_flip($input_array));
    }

    public static function validate_numbers($numbers) {
        // Remove all space from numbers
        $space_removed = self::remove_all_space_in_string($numbers);
    
        // Remove illegal characters
        $long_numbers_with_slash = [];
        $i = 0;
        foreach ($space_removed as $number) {
            if (strlen($number) < 7) {
                unset($space_removed[$i]);
            }
            if (strpos($number, ',') !== false) {
                unset($space_removed[$i]);
            }
            if (strpos($number, '/') !== false) {
                $long_numbers_with_slash[] = $number;
                unset($space_removed[$i]);
            }
            if (strlen($number) > 7) {
                unset($space_removed[$i]);
            }
            $i++;
        }

        // Add numbers split by '/' to array
        $long_numbers_with_illegal = self::split_string_by_slash($long_numbers_with_slash);
        $long_numbers = [];
        $j = 0;
        foreach ($long_numbers as $number) {
            if (strlen($number) < 7) {
                unset($long_numbers_with_illegal[$j]);
            }
            if (strlen($number) > 7) {
                unset($long_numbers_with_illegal[$j]);
            }
            $j++;
        }

        // Merge and remove Duplicates
        $long_numbers = array_values($long_numbers);
        $space_removed = array_values($space_removed);
        $merged = array_merge($space_removed, $long_numbers);
        $final = array_unique($merged);

        return $final;
        // dd(self::check_for_duplicates($final));
    }

    public static function check_if_group_exists($name) {
        $group = \App\Contact::where('group_name', $name)->get();
        if ($group->isEmpty()) {
            return true;
        }
        return false;
    }
}