<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'social_id',
        'is_admin',
        'device_token',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }



    public static function makeDirectory($image_folder_type)
    {
//        $image_folder_type = 1;
        $year = date("Y");
        $month = date("m");
        $day = date("d");
        if(config('custom.image_folders')[$image_folder_type] == 'setting'){
            if (!is_dir(public_path().'/images/setting/'.$year.'/'.$month.'/'.$day)) {
                mkdir(public_path().'/images/setting/'.$year.'/'.$month.'/'.$day, 0755, true);
            }
            return $directory = 'images/setting/'.$year.'/'.$month.'/'.$day.'/';
        }
        if(config('custom.image_folders')[$image_folder_type] == 'project'){
            if (!is_dir(public_path().'/images/project/'.$year.'/'.$month.'/'.$day)) {
                mkdir(public_path().'/images/project/'.$year.'/'.$month.'/'.$day, 0755, true);
            }
            return $directory = 'images/project/'.$year.'/'.$month.'/'.$day.'/';
        }
        if(config('custom.image_folders')[$image_folder_type] == 'ndis_plan'){
            if (!is_dir(public_path().'/images/ndis_plan/'.$year.'/'.$month.'/'.$day)) {
                mkdir(public_path().'/images/ndis_plan/'.$year.'/'.$month.'/'.$day, 0755, true);
            }
            return $directory = 'images/ndis_plan/'.$year.'/'.$month.'/'.$day.'/';
        }

        if(config('custom.image_folders')[$image_folder_type] == 'service'){
            if (!is_dir(public_path().'/images/service/'.$year.'/'.$month.'/'.$day)) {
                mkdir(public_path().'/images/service/'.$year.'/'.$month.'/'.$day, 0755, true);
            }
            return $directory = 'images/service/'.$year.'/'.$month.'/'.$day.'/';
        }
        if(config('custom.image_folders')[$image_folder_type] == 'gallery'){
            if (!is_dir(public_path().'/images/gallery/'.$year.'/'.$month.'/'.$day)) {
                mkdir(public_path().'/images/gallery/'.$year.'/'.$month.'/'.$day, 0755, true);
            }
            return $directory = 'images/gallery/'.$year.'/'.$month.'/'.$day.'/';
        }
        if(config('custom.image_folders')[$image_folder_type] == 'academy'){
            if (!is_dir(public_path().'/images/academy/'.$year.'/'.$month.'/'.$day)) {
                mkdir(public_path().'/images/academy/'.$year.'/'.$month.'/'.$day, 0755, true);
            }
            return $directory = 'images/academy/'.$year.'/'.$month.'/'.$day.'/';
        }
        if(config('custom.image_folders')[$image_folder_type] == 'blog'){
            if (!is_dir(public_path().'/images/blog/'.$year.'/'.$month.'/'.$day)) {
                mkdir(public_path().'/images/blog/'.$year.'/'.$month.'/'.$day, 0755, true);
            }
            return $directory = 'images/blog/'.$year.'/'.$month.'/'.$day.'/';
        }
        if(config('custom.image_folders')[$image_folder_type] == 'news'){
            if (!is_dir(public_path().'/images/news/'.$year.'/'.$month.'/'.$day)) {
                mkdir(public_path().'/images/news/'.$year.'/'.$month.'/'.$day, 0755, true);
            }
            return $directory = 'images/news/'.$year.'/'.$month.'/'.$day.'/';
        }
        if(config('custom.image_folders')[$image_folder_type] == 'notice'){
            if (!is_dir(public_path().'/images/notice/'.$year.'/'.$month.'/'.$day)) {
                mkdir(public_path().'/images/notice/'.$year.'/'.$month.'/'.$day, 0755, true);
            }
            return $directory = 'images/notice/'.$year.'/'.$month.'/'.$day.'/';
        }
        if(config('custom.image_folders')[$image_folder_type] == 'testimonial'){
            if (!is_dir(public_path().'/images/testimonial/'.$year.'/'.$month.'/'.$day)) {
                mkdir(public_path().'/images/testimonial/'.$year.'/'.$month.'/'.$day, 0755, true);
            }
            return $directory = 'images/testimonial/'.$year.'/'.$month.'/'.$day.'/';
        }
        if(config('custom.image_folders')[$image_folder_type] == 'client'){
            if (!is_dir(public_path().'/images/client/'.$year.'/'.$month.'/'.$day)) {
                mkdir(public_path().'/images/client/'.$year.'/'.$month.'/'.$day, 0755, true);
            }
            return $directory = 'images/client/'.$year.'/'.$month.'/'.$day.'/';
        }
        if(config('custom.image_folders')[$image_folder_type] == 'slider') {
            if (!is_dir(public_path() . '/images/slider/' . $year . '/' . $month . '/' . $day)) {
                mkdir(public_path() . '/images/slider/' . $year . '/' . $month . '/' . $day, 0755, true);
            }
            return $directory = 'images/slider/' . $year . '/' . $month . '/' . $day . '/';
        }
        if(config('custom.image_folders')[$image_folder_type] == 'profile_image') {
            if (!is_dir(public_path() . '/images/profile_image/' . $year . '/' . $month . '/' . $day)) {
                mkdir(public_path() . '/images/profile_image/' . $year . '/' . $month . '/' . $day, 0755, true);
            }
            return $directory = 'images/profile_image/' . $year . '/' . $month . '/' . $day . '/';
        }
        if(config('custom.image_folders')[$image_folder_type] == 'identification_image') {
            if (!is_dir(public_path() . '/images/identification_image/' . $year . '/' . $month . '/' . $day)) {
                mkdir(public_path() . '/images/identification_image/' . $year . '/' . $month . '/' . $day, 0755, true);
            }
            return $directory = 'images/identification_image/' . $year . '/' . $month . '/' . $day . '/';
        }
        if(config('custom.image_folders')[$image_folder_type] == 'proof_of_residency_image') {
            if (!is_dir(public_path() . '/images/proof_of_residency_image/' . $year . '/' . $month . '/' . $day)) {
                mkdir(public_path() . '/images/proof_of_residency_image/' . $year . '/' . $month . '/' . $day, 0755, true);
            }
            return $directory = 'images/proof_of_residency_image/' . $year . '/' . $month . '/' . $day . '/';
        }
        if(config('custom.image_folders')[$image_folder_type] == 'payment_slip') {
            if (!is_dir(public_path() . '/images/payment_slip/' . $year . '/' . $month . '/' . $day)) {
                mkdir(public_path() . '/images/payment_slip/' . $year . '/' . $month . '/' . $day, 0755, true);
            }
            return $directory = 'images/payment_slip/' . $year . '/' . $month . '/' . $day . '/';
        }
        if(config('custom.image_folders')[$image_folder_type] == 'document') {
            if (!is_dir(public_path() . '/images/document/' . $year . '/' . $month . '/' . $day)) {
                mkdir(public_path() . '/images/document/' . $year . '/' . $month . '/' . $day, 0755, true);
            }
            return $directory = 'images/document/' . $year . '/' . $month . '/' . $day . '/';
        }
        if (config('custom.image_folders')[$image_folder_type] == 'team') {
            if (!is_dir(public_path() . '/images/team/' . $year . '/' . $month . '/' . $day)) {
                mkdir(public_path() . '/images/team/' . $year . '/' . $month . '/' . $day, 0755, true);
            }
            return $directory = 'images/team/' . $year . '/' . $month . '/' . $day . '/';
        }




    }

    public  static function save_image($requestData,$extension,$count,$image_folder_type)
    {
        $directory = self::makeDirectory($image_folder_type);
        $uploaded_name = $requestData->getClientOriginalName();
        $uploaded_ext = $requestData->getClientOriginalExtension();
        $uploaded_type = $requestData->getClientMimeType();
        $uploaded_tmp = $requestData->getPathname();



        // Where are we going to be writing to?
        $target_path   = $directory;

        //$target_file   = basename( $uploaded_name, '.' . $uploaded_ext ) . '-';
        $target_file   =  md5( uniqid() . $uploaded_name ) . '.' . $uploaded_ext;
        $temp_file     = ( ( ini_get( 'upload_tmp_dir' ) == '' ) ? ( sys_get_temp_dir() ) : ( ini_get( 'upload_tmp_dir' ) ) );
        $temp_file    .= DIRECTORY_SEPARATOR . md5( uniqid() . $uploaded_name ) . '.' . $uploaded_ext;


        // Is it an image?
        if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' ) &&
            ( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' ) &&
            getimagesize( $uploaded_tmp ) ) {
            // Strip any metadata, by re-encoding image (Note, using php-Imagick is recommended over php-GD)
            if( $uploaded_type == 'image/jpeg' ) {
                $img = imagecreatefromjpeg( $uploaded_tmp );
                imagejpeg( $img, $temp_file, 100);
            }
            else {
                $imagedata = getimagesize($requestData);
                $width = $imagedata[0];
                $height = $imagedata[1];
                $img = imagecreatefrompng( $uploaded_tmp );
                $new_image = imagecreatetruecolor ( $width, $height );
                imagealphablending($new_image , false);
                imagesavealpha($new_image , true);
                imagecopyresampled ( $new_image, $img, 0, 0, 0, 0, $width, $height, imagesx ( $img ), imagesy ( $img ) );
                $img = $new_image;
                // saving
                imagealphablending($img , false);
                imagesavealpha($img , true);
                imagepng ( $img, $temp_file);

//                imagepng( $img, $temp_file, 100);
            }
            imagedestroy( $img);

            //moving image
            if( rename( $temp_file, ( $target_path . $target_file ) ) ) {
                $image_path = $target_path . $target_file;
                $doc_name = md5(date('Ymd').'_@id'.$count.uniqid());
                return [$image_path,$doc_name];
            }
        }
        if(strtolower( $uploaded_ext ) == 'svg' && $uploaded_type =='image/svg+xml'){
            $target_path   = $target_path;
            $content =  file_get_contents($requestData);
            if(file_put_contents( $target_path.$target_file,$content)){
                return($target_path.$target_file);
            }
        }
        if(strtolower( $uploaded_ext ) == 'docx' || strtolower( $uploaded_ext ) == 'pdf'){
            $target_path   = $target_path;
            $content =  file_get_contents($requestData);
            if(file_put_contents( $target_path.$target_file,$content)){
                return($target_path.$target_file);
            }
        }
        
    }

    public function member(){
        return $this->hasOne(Member::class);
    }
}
