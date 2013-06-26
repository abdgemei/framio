<?php
App::uses('AppModel', 'Model');
/**
 * Upload Model
 *
 * @property User $User
 */
class Upload extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
    public $useTable = 'upload';

/**
 * Display field
 *
 * @var string
 */
    public $displayField = 'title';


    //The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
    public $hasOne = array(
        'ProfilePicture',
        'Photo' => array(
            'dependent' => true
        )
    );
    
    // public $hasMany = array(
    //     'ProfilePictures' => array(
    //         'className' => 'ProfilePicture',
    //         'foreignKey' => '',
    //         'conditions' => '',
    //         'fields' => '',
    //         'order' => ''
    //     )    
    // );
    
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

    protected function getGps($exifCoord, $hemi) {
    
        $degrees = count($exifCoord) > 0 ? $this->gps2Num($exifCoord[0]) : 0;
        $minutes = count($exifCoord) > 1 ? $this->gps2Num($exifCoord[1]) : 0;
        $seconds = count($exifCoord) > 2 ? $this->gps2Num($exifCoord[2]) : 0;
    
        $flip = ($hemi == 'W' or $hemi == 'S') ? -1 : 1;
    
        return $flip * ($degrees + $minutes / 60 + $seconds / 3600);
    
    }
    
    protected function gps2Num($coordPart) {
    
        $parts = explode('/', $coordPart);
    
        if (count($parts) <= 0)
            return 0;
    
        if (count($parts) == 1)
            return $parts[0];
    
        return floatval($parts[0]) / floatval($parts[1]);
    }

    public function getMetadata($id) {

        if ((isset($id)) and (file_exists(WWW_ROOT.DS.'content'.DS.$id))) {
        
          // There are 2 arrays which contains the information we are after, so it's easier to state them both
          $exif_ifd0 = read_exif_data(FULL_BASE_URL.'/content/'.$id ,'IFD0' ,0);       
          $exif_exif = read_exif_data(FULL_BASE_URL.'/content/'.$id ,'EXIF' ,0);
          
          // pr($exif_ifd0); pr($exif_exif); die;

          //error control
          $notFound = "Unavailable";
          
          // Make 
          if (@array_key_exists('Make', $exif_ifd0)) {
            $camMake = $exif_ifd0['Make'];
          } else { $camMake = $notFound; }
          
          // Model
          if (@array_key_exists('Model', $exif_ifd0)) {
            $camModel = $exif_ifd0['Model'];
          } else { $camModel = $notFound; }
          
          // Exposure
          if (@array_key_exists('ExposureTime', $exif_ifd0)) {
            $camExposure = $exif_ifd0['ExposureTime'];
          } else { $camExposure = $notFound; }
    
          // Aperture
          if (@array_key_exists('ApertureFNumber', $exif_ifd0['COMPUTED'])) {
            $camAperture = $exif_ifd0['COMPUTED']['ApertureFNumber'];
          } else { $camAperture = $notFound; }
          
          // Date
          if (@array_key_exists('DateTime', $exif_ifd0)) {
            $camDate = $exif_ifd0['DateTime'];
          } else { $camDate = $notFound; }
          
          // ISO
          if (@array_key_exists('ISOSpeedRatings',$exif_exif)) {
            $camIso = $exif_exif['ISOSpeedRatings'];
          } else { $camIso = $notFound; }
          
          // XResolution
          if (@array_key_exists('XResolution',$exif_ifd0)) {
            $camXResolution = $exif_ifd0['XResolution'];
          } else { $camXResolution = $notFound; }

          // YResolution
          if (@array_key_exists('YResolution',$exif_ifd0)) {
            $camYResolution = $exif_ifd0['YResolution'];
          } else { $camYResolution = $notFound; }

          // Orientation
          if (@array_key_exists('Orientation',$exif_ifd0)) {
            $camOrientation = $exif_ifd0['Orientation'];
          } else { $camOrientation = $notFound; }

          // Focal Length
          if (@array_key_exists('FocalLength',$exif_ifd0)) {
            $camFocalLength = $exif_ifd0['FocalLength'];
          } else { $camFocalLength = $notFound; }

          // Flash
          if (@array_key_exists('Flash',$exif_ifd0)) {
            $camFlash = $exif_ifd0['Flash'];
          } else { $camFlash = $notFound; }

          // GPS Latitude
          if (@array_key_exists('GPSLatitude',$exif_ifd0) && @array_key_exists('GPSLatitude',$exif_ifd0)) {
            $camGPSLat = $this->getGps($exif_ifd0["GPSLatitude"], $exif_ifd0['GPSLatitude']);
          } else { $camGPSLat = $notFound; }

          // GPS Longitude
          if (@array_key_exists('GPSLongitude',$exif_ifd0) && @array_key_exists('GPSLongitude',$exif_ifd0)) {
            $camGPSLon = $this->getGps($exif_ifd0["GPSLongitude"], $exif_ifd0['GPSLongitude']);
          } else { $camGPSLon = $notFound; }

          $return = array();
          $return['date_taken'] = $camDate;
          $return['camera_make'] = $camMake;
          $return['camera_model'] = $camModel;
          $return['x_resolution'] = $camXResolution;
          $return['y_resolution'] = $camYResolution;
          $return['orientation'] = $camOrientation;
          $return['focal_length'] = $camFocalLength;
          $return['aperture'] = $camAperture;
          $return['iso_speed'] = $camIso;
          $return['gps_longitude'] = $camGPSLon;
          $return['gps_latitude'] = $camGPSLat;
          $return['exposure_time'] = $camExposure;
          $return['flash'] = $camFlash;
          // pr($return); die;
          return $return;
        
        } else {
          //pr('fail');die;
          return false; 
        } 
    }
}
