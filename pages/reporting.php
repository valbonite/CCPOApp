<?php
session_start();

include('connection.php');
require('../vendor/autoload.php');


if( isset( $_POST["submit"])) {
    function validateFormData ( $formData ) {
        $formData = trim( stripcslashes( htmlspecialchars( $formData)));
        return $formData;
    }

    if (!$_POST["encoder"]) {
        $encoderError = "Please enter the encoder <br>";
    } else {
        $encoder = validateFormData( $_POST["encoder"]);
    }

    if (!$_POST["source"]) {
        $sourceError = "Please enter the source <br>";
    } else {
        $source = validateFormData( $_POST["source"]);
    }

    if (!$_POST["date"]) {
        $dateError = "Please enter the date <br>";
    } else {
        $date = validateFormData( $_POST["date"]);
    }

    if (!$_POST["datereptd"]) {
        $datereptdError = "Please enter the date reported <br>";
    } else {
        $datereptd = validateFormData( $_POST["datereptd"]);
    }

    if (!$_POST["day"]) {
        $dayError = "Please enter the day <br>";
    } else {
        $day = validateFormData( $_POST["day"]);
    }

    if (!$_POST["time"]) {
        $timeError = "Please enter the time <br>";
    } else {
        $time = validateFormData( $_POST["time"]);
    }

    if (!$_POST["entryno"]) {
        $entrynoError = "Please enter the entry no. <br>";
    } else {
        $entryno = validateFormData( $_POST["entryno"]);
    }

    if (!$_POST["ppo"]) {
        $ppoError = "Please enter the ppo <br>";
    } else {
        $ppo = validateFormData( $_POST["ppo"]);
    }

    if (!$_POST["unitstation"]) {
        $unitstationError = "Please enter the ppo <br>";
    } else {
        $unitstation = validateFormData( $_POST["unitstation"]);
    }

    if (!$_POST["areaofincident"]) {
        $areaofincidentError = "Please enter the area of incident <br>";
    } else {
        $areaofincident = validateFormData( $_POST["areaofincident"]);
    }

    if (!$_POST["barangay"]) {
        $barangayError = "Please enter the barangay <br>";
    } else {
        $barangay = validateFormData( $_POST["barangay"]);
    }

    if (!$_POST["street"]) {
        $streetError = "Please enter the street <br>";
    } else {
        $street = validateFormData( $_POST["street"]);
    }

    if (!$_POST["latitude"]) {
        $latitudeError = "Please enter the latitude <br>";
    } else {
        $latitude = validateFormData( $_POST["latitude"]);
    }

    if (!$_POST["longitude"]) {
        $longitudeError = "Please enter the longitude <br>";
    } else {
        $longitude = validateFormData( $_POST["longitude"]);
    }

    if (!$_POST["crimetype"]) {
        $crimetypeError = "Please enter the crime type <br>";
    } else {
        $crimetype = validateFormData( $_POST["crimetype"]);
    }

    if (!$_POST["indexcrimetype"]) {
        $indexcrimetypeError = "Please enter the index crime type <br>";
    } else {
        $indexcrimetype = validateFormData( $_POST["indexcrimetype"]);
    }

    if (!$_POST["crimecategory"]) {
        $crimecategoryError = "Please enter the crime category <br>";
    } else {
        $crimecategory = validateFormData( $_POST["crimecategory"]);
    }

    if (!$_POST["classification"]) {
        $classificationError = "Please enter the classification <br>";
    } else {
        $classification = validateFormData( $_POST["classification"]);
    }

    if (!$_POST["modeofcommission"]) {
        $modeofcommissionError = "Please enter the mode of commission <br>";
    } else {
        $modeofcommission = validateFormData( $_POST["modeofcommission"]);
    }

    if (!$_POST["streetcrime"]) {
        $streetcrimeError = "Please enter the mode of streetcrime <br>";
    } else {
        $streetcrime = validateFormData( $_POST["streetcrime"]);
    }

    if (!$_POST["involveminor"]) {
        $involveminorError = "Please enter the mode of involveminor <br>";
    } else {
        $involveminor = validateFormData( $_POST["involveminor"]);
    }

    if (!$_POST["specialcase"]) {
        $specialcaseError = "Please enter the mode of specialcase <br>";
    } else {
        $specialcase = validateFormData( $_POST["specialcase"]);
    }

    if (!$_POST["weaponused"]) {
        $weaponusedError = "Please enter the mode of weaponused <br>";
    } else {
        $weaponused = validateFormData( $_POST["weaponused"]);
    }

    if (!$_POST["facaliber"]) {
        $facaliberError = "Please enter the mode of facaliber <br>";
    } else {
        $facaliber = validateFormData( $_POST["facaliber"]);
    }

    if (!$_POST["fastatus"]) {
        $fastatusError = "Please enter the mode of fastatus <br>";
    } else {
        $fastatus = validateFormData( $_POST["fastatus"]);
    }

    if (!$_POST["falicenseno"]) {
        $falicensenoError = "Please enter the mode of falicenseno <br>";
    } else {
        $falicenseno = validateFormData( $_POST["falicenseno"]);
    }

    if (!$_POST["crsfirearms"]) {
        $crsfirearmsError = "Please enter the mode of crsfirearms <br>";
    } else {
        $crsfirearms = validateFormData( $_POST["crsfirearms"]);
    }

    if (!$_POST["fadisposition"]) {
        $fadispositionError = "Please enter the mode of fadisposition <br>";
    } else {
        $fadisposition = validateFormData( $_POST["fadisposition"]);
    }

    if (!$_POST["transport"]) {
        $transportError = "Please enter the mode of transport <br>";
    } else {
        $transport = validateFormData( $_POST["transport"]);
    }

    if (!$_POST["motorcycleridingcriminals"]) {
        $motorcycleridingcriminalsError = "Please enter the mode of motorcycleridingcriminals <br>";
    } else {
        $motorcycleridingcriminals = validateFormData( $_POST["motorcycleridingcriminals"]);
    }

    if (!$_POST["driversuspect"]) {
        $driversuspectError = "Please enter the mode of driversuspect <br>";
    } else {
        $driversuspect = validateFormData( $_POST["driversuspect"]);
    }

    if (!$_POST["vehowner"]) {
        $vehownerError = "Please enter the mode of vehowner <br>";
    } else {
        $vehowner = validateFormData( $_POST["vehowner"]);
    }

    if (!$_POST["vehtype"]) {
        $vehtypeError = "Please enter the mode of vehtype <br>";
    } else {
        $vehtype = validateFormData( $_POST["vehtype"]);
    }

    if (!$_POST["vehplatenum"]) {
        $vehplatenumError = "Please enter the mode of vehplatenum <br>";
    } else {
        $vehplatenum = validateFormData( $_POST["vehplatenum"]);
    }

    if (!$_POST["drugs"]) {
        $drugsError = "Please enter the mode of drugs <br>";
    } else {
        $drugs = validateFormData( $_POST["drugs"]);
    }

    if (!$_POST["drugconfiscateditem"]) {
        $drugconfiscateditemError = "Please enter the mode of drugconfiscateditem <br>";
    } else {
        $drugconfiscateditem = validateFormData( $_POST["drugconfiscateditem"]);
    }

    if (!$_POST["gambling"]) {
        $gamblingError = "Please enter the mode of gambling <br>";
    } else {
        $gambling = validateFormData( $_POST["gambling"]);
    }

    if (!$_POST["gamblingconfiscateditem"]) {
        $gamblingconfiscateditemError = "Please enter the gamblingconfiscateditem <br>";
    } else {
        $gamblingconfiscateditem = validateFormData( $_POST["gamblingconfiscateditem"]);
    }

    if (!$_POST["gamblingamountconfiscated"]) {
        $gamblingamountconfiscatedError = "Please enter the gamblingamountconfiscated <br>";
    } else {
        $gamblingamountconfiscated = validateFormData( $_POST["gamblingamountconfiscated"]);
    }

    if (!$_POST["rec_unrec"]) {
        $rec_unrecError = "Please enter the barangay <br>";
    } else {
        $rec_unrec = validateFormData( $_POST["rec_unrec"]);
    }

    if (!$_POST["robberytype"]) {
        $robberytypeError = "Please enter the robberytype <br>";
    } else {
        $robberytype = validateFormData( $_POST["robberytype"]);
    }

    if (!$_POST["bankrobberyamount"]) {
        $bankrobberyamountError = "Please enter the bankrobberyamount <br>";
    } else {
        $bankrobberyamount = validateFormData( $_POST["bankrobberyamount"]);
    }

    if (!$_POST["establishmenttype"]) {
        $establishmenttypeError = "Please enter the establishmenttype <br>";
    } else {
        $establishmenttype = validateFormData( $_POST["establishmenttype"]);
    }

    if (!$_POST["establishmentname"]) {
        $establishmentnameError = "Please enter the establishmentname <br>";
    } else {
        $establishmentname = validateFormData( $_POST["establishmentname"]);
    }

    if (!$_POST["casestatus"]) {
        $casestatusError = "Please enter the casestatus <br>";
    } else {
        $casestatus = validateFormData( $_POST["casestatus"]);
    }

    if (!$_POST["solved"]) {
        $solvedError = "Please enter the solved <br>";
    } else {
        $solved = validateFormData( $_POST["solved"]);
    }

    if (!$_POST["cleared"]) {
        $clearedError = "Please enter the cleared <br>";
    } else {
        $cleared = validateFormData( $_POST["cleared"]);
    }

    if (!$_POST["uncleared_unsolved"]) {
        $uncleared_unsolvedError = "Please enter the uncleared_unsolved <br>";
    } else {
        $uncleared_unsolved = validateFormData( $_POST["uncleared_unsolved"]);
    }

    if (!$_POST["arrest"]) {
        $arrestError = "Please enter the mode of arrest <br>";
    } else {
        $arrest = validateFormData( $_POST["arrest"]);
    }

    if (!$_POST["numarrested"]) {
        $numarrestedError = "Please enter the mode of numarrested <br>";
    } else {
        $numarrested = validateFormData( $_POST["numarrested"]);
    }

    if (!$_POST["datefiled"]) {
        $datefiledError = "Please enter the mode of datefiled <br>";
    } else {
        $datefiled = validateFormData( $_POST["datefiled"]);
    }

    if (!$_POST["iscasenum"]) {
        $iscasenumError = "Please enter the mode of iscasenum <br>";
    } else {
        $iscasenum = validateFormData( $_POST["iscasenum"]);
    }

    if (!$_POST["numvictim"]) {
        $numvictimError = "Please enter the mode of numvictim <br>";
    } else {
        $numvictim = validateFormData( $_POST["numvictim"]);
    }

    if (!$_POST["namevictim"]) {
        $namevictimError = "Please enter the mode of namevictim <br>";
    } else {
        $namevictim = validateFormData( $_POST["namevictim"]);
    }

    if (!$_POST["addressvictim"]) {
        $addressvictimError = "Please enter the mode of addressvictim <br>";
    } else {
        $addressvictim = validateFormData( $_POST["addressvictim"]);
    }

    if (!$_POST["victimoccupation"]) {
        $victimoccupationError = "Please enter the mode of victimoccupation <br>";
    } else {
        $victimoccupation = validateFormData( $_POST["victimoccupation"]);
    }

    if (!$_POST["victimoccupationagency"]) {
        $victimoccupationagencyError = "Please enter the mode of victimoccupationagency <br>";
    } else {
        $victimoccupationagency = validateFormData( $_POST["victimoccupationagency"]);
    }

    if (!$_POST["victimage"]) {
        $victimageError = "Please enter the mode of victimage <br>";
    } else {
        $victimage = validateFormData( $_POST["victimage"]);
    }

    if (!$_POST["victimagegroup"]) {
        $victimagegroupError = "Please enter the mode of victimagegroup <br>";
    } else {
        $victimagegroup = validateFormData( $_POST["victimagegroup"]);
    }

    if (!$_POST["victimsex"]) {
        $victimsexError = "Please enter the mode of victimsex <br>";
    } else {
        $victimsex = validateFormData( $_POST["victimsex"]);
    }

    if (!$_POST["victimcs"]) {
        $victimcsError = "Please enter the mode of victimcs <br>";
    } else {
        $victimcs = validateFormData( $_POST["victimcs"]);
    }

    if (!$_POST["victimtourist"]) {
        $victimtouristError = "Please enter the mode of victimtourist <br>";
    } else {
        $victimtourist = validateFormData( $_POST["victimtourist"]);
    }

    if (!$_POST["victimnationality"]) {
        $victimnationalityError = "Please enter the mode of victimnationality <br>";
    } else {
        $victimnationality = validateFormData( $_POST["victimnationality"]);
    }

    if (!$_POST["victimethnicity"]) {
        $victimethnicityError = "Please enter the mode of victimethnicity <br>";
    } else {
        $victimethnicity = validateFormData( $_POST["victimethnicity"]);
    }

    if (!$_POST["victimdefect"]) {
        $victimdefectError = "Please enter the mode of victimdefect <br>";
    } else {
        $victimdefect = validateFormData( $_POST["victimdefect"]);
    }

    if (!$_POST["victimstatus"]) {
        $victimstatusError = "Please enter the mode of victimstatus <br>";
    } else {
        $victimstatus = validateFormData( $_POST["victimstatus"]);
    }

    if (!$_POST["victimdrugalcohol"]) {
        $victimdrugalcoholError = "Please enter the mode of victimdrugalcohol <br>";
    } else {
        $victimdrugalcohol = validateFormData( $_POST["victimdrugalcohol"]);
    }

    if (!$_POST["numsuspect"]) {
        $numsuspectError = "Please enter the mode of numsuspect <br>";
    } else {
        $numsuspect = validateFormData( $_POST["numsuspect"]);
    }

    if (!$_POST["namesuspect"]) {
        $namesuspectError = "Please enter the mode of namesuspect <br>";
    } else {
        $namesuspect = validateFormData( $_POST["namesuspect"]);
    }

    if (!$_POST["addresssuspect"]) {
        $addresssuspectError = "Please enter the mode of addresssuspect <br>";
    } else {
        $addresssuspect = validateFormData( $_POST["addresssuspect"]);
    }

    if (!$_POST["suspectbirthplace"]) {
        $suspectbirthplaceError = "Please enter the mode of suspectbirthplace <br>";
    } else {
        $suspectbirthplace = validateFormData( $_POST["suspectbirthplace"]);
    }

    if (!$_POST["suspectdistinctmark"]) {
        $suspectdistinctmarkError = "Please enter the mode of suspectdistinctmark <br>";
    } else {
        $suspectdistinctmark = validateFormData( $_POST["suspectdistinctmark"]);
    }

    if (!$_POST["suspectsex"]) {
        $suspectsexError = "Please enter the mode of suspectsex <br>";
    } else {
        $suspectsex = validateFormData( $_POST["suspectsex"]);
    }

    if (!$_POST["suspectcs"]) {
        $suspectcsError = "Please enter the mode of suspectcs <br>";
    } else {
        $suspectcs = validateFormData( $_POST["suspectcs"]);
    }

    if (!$_POST["suspectheight"]) {
        $suspectheightError = "Please enter the mode of suspectheight <br>";
    } else {
        $suspectheight = validateFormData( $_POST["suspectheight"]);
    }

    if (!$_POST["suspectweight"]) {
        $suspectweightError = "Please enter the mode of suspectweight <br>";
    } else {
        $suspectweight = validateFormData( $_POST["suspectweight"]);
    }

    if (!$_POST["suspectbday"]) {
        $suspectbdayError = "Please enter the mode of suspectbday <br>";
    } else {
        $suspectbday = validateFormData( $_POST["suspectbday"]);
    }

    if (!$_POST["suspectage"]) {
        $suspectageError = "Please enter the mode of suspectage <br>";
    } else {
        $suspectage = validateFormData( $_POST["suspectage"]);
    }

    if (!$_POST["suspecthaircolor"]) {
        $suspecthaircolorError = "Please enter the mode of suspecthaircolor <br>";
    } else {
        $suspecthaircolor = validateFormData( $_POST["suspecthaircolor"]);
    }

    if (!$_POST["suspectoccupation"]) {
        $suspectoccupationError = "Please enter the mode of suspectoccupation <br>";
    } else {
        $suspectoccupation = validateFormData( $_POST["suspectoccupation"]);
    }

    if (!$_POST["suspectoccupationagency"]) {
        $suspectoccupationagencyError = "Please enter the mode of suspectoccupationagency <br>";
    } else {
        $suspectoccupationagency = validateFormData( $_POST["suspectoccupationagency"]);
    }

    if (!$_POST["suspectnationality"]) {
        $suspectnationalityError = "Please enter the mode of suspectnationality <br>";
    } else {
        $suspectnationality = validateFormData( $_POST["suspectnationality"]);
    }

    if (!$_POST["suspectethnicity"]) {
        $suspectethnicityError = "Please enter the mode of suspectethnicity <br>";
    } else {
        $suspectethnicity = validateFormData( $_POST["suspectethnicity"]);
    }

    if (!$_POST["suspectforeigner"]) {
        $suspectforeignerError = "Please enter the mode of suspectforeigner <br>";
    } else {
        $suspectforeigner = validateFormData( $_POST["suspectforeigner"]);
    }

    if (!$_POST["suspectgang"]) {
        $suspectgangError = "Please enter the mode of suspectgang <br>";
    } else {
        $suspectgang = validateFormData( $_POST["suspectgang"]);
    }

    if (!$_POST["suspectprevcriminal"]) {
        $suspectprevcriminalError = "Please enter the mode of suspectprevcriminal <br>";
    } else {
        $suspectprevcriminal = validateFormData( $_POST["suspectprevcriminal"]);
    }

    if (!$_POST["suspectpnpmember"]) {
        $suspectpnpmemberError = "Please enter the mode of suspectpnpmember <br>";
    } else {
        $suspectpnpmember = validateFormData( $_POST["suspectpnpmember"]);
    }

    if (!$_POST["suspectdrugalcohol"]) {
        $suspectdrugalcoholError = "Please enter the mode of suspectdrugalcohol <br>";
    } else {
        $suspectdrugalcohol = validateFormData( $_POST["suspectdrugalcohol"]);
    }

    if (!$_POST["suspectdisposition"]) {
        $suspectdispositionError = "Please enter the mode of suspectdisposition <br>";
    } else {
        $suspectdisposition = validateFormData( $_POST["suspectdisposition"]);
    }

    if (!$_POST["investigator"]) {
        $investigatorError = "Please enter the mode of investigator <br>";
    } else {
        $investigator = validateFormData( $_POST["investigator"]);
    }

    if (!$_POST["narrative"]) {
        $narrativeError = "Please enter the mode of narrative <br>";
    } else {
        $narrative = validateFormData( $_POST["narrative"]);
    }

    if (!$_POST["progressreport"]) {
        $progressreportError = "Please enter the mode of progressreport <br>";
    } else {
        $progressreport = validateFormData( $_POST["progressreport"]);
    }

    $query = "INSERT INTO master_data ( id, encoder, source, datereptd, date, day, time, entryno, ppo, areaofincident, barangay, street, latitude, longitude, crimetype, indexcrimetype, crimecategory, classification, modeofcommission, streetcrime, involveminor, specialcase, weaponused, facaliber, fastatus, falicenseno, crsfirearms, fadisposition, transport, motorcycleridingcriminals, driversuspect, vehowner, vehtype, vehplatenum, drugs, drugconfiscateditem, gambling, gamblingconfiscateditem, gamblingamountconfiscated, rec_unrec, robberytype, bankrobberyamount, establishmenttype, establishmentname, casestatus, solved, cleared, uncleared_unsolved, arrest, numarrested, datefiled, iscasenum, numvictim, namevictim, addressvictim, victimoccupation, victimoccupationagency, victimage, victimagegroup, victimsex, victimcs, victimtourist, victimnationality, victimethnicity, victimdefect, victimstatus, victimdrugalcohol, numsuspect, namesuspect, addresssuspect, suspectbirthplace, suspectdistinctmark, suspectsex, suspectcs, suspectheight, suspectweight, suspectbday, suspectage, suspecthaircolor, suspectoccupation, suspectoccupationagency, suspectnationality, suspectethnicity, suspectforeigner, suspectgang, suspectprevcriminal, suspectpnpmember, suspectdrugalcohol, suspectdisposition, investigator, narrative, progressreport ) VALUES ( NULL, '$encoder', '$source', '$datereptd', '$date', '$day', '$time', '$entryno', '$ppo', '$areaofincident', '$barangay', '$street', '$latitude', '$longitude', '$crimetype', '$indexcrimetype', '$crimecategory', '$classification', '$modeofcommission', '$streetcrime', '$involveminor', '$specialcase', '$weaponused', '$facaliber', '$fastatus', '$falicenseno', '$crsfirearms', '$fadisposition', '$transport', '$motorcycleridingcriminals', '$driversuspect', '$vehowner', '$vehtype', '$vehplatenum', '$drugs', '$drugconfiscateditem', '$gambling', '$gamblingconfiscateditem', '$gamblingamountconfiscated', '$rec_unrec', '$robberytype', '$bankrobberyamount', '$establishmenttype', '$establishmentname', '$casestatus', '$solved', '$cleared', '$uncleared_unsolved', '$arrest', '$numarrested', '$datefiled', '$iscasenum', '$numvictim', '$namevictim', '$addressvictim', '$victimoccupation', '$victimoccupationagency', '$victimage', '$victimagegroup', '$victimsex', '$victimcs', '$victimtourist', '$victimnationality', '$victimethnicity', '$victimdefect', '$victimstatus', '$victimdrugalcohol', '$numsuspect', '$namesuspect', '$addresssuspect', '$suspectbirthplace', '$suspectdistinctmark', '$suspectsex', '$suspectcs', '$suspectheight', '$suspectweight', '$suspectbday', '$suspectage', '$suspecthaircolor', '$suspectoccupation', '$suspectoccupationagency', '$suspectnationality', '$suspectethnicity', '$suspectforeigner', '$suspectgang','$suspectprevcriminal', '$suspectpnpmember', '$suspectdrugalcohol', '$suspectdisposition', '$investigator', '$narrative', '$progressreport' )";

    if(mysqli_query($connection, $query)){
        echo "New record in database!";
    } else {
        echo "Error: ". $query . "<br>" . mysqli_error($connection);
    }
}

mysqli_close($connection);

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reporting - CCPO Crime Prediction</title>

    <!-- Include Required Prerequisites -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/latest/css/bootstrap.css" />
 
    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

    <script type="text/javascript" src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Pace-->
    <script src="../dist/js/pace.min.js"></script>
    <link href="../dist/css/pace-loading-bar.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/primary.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">




    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.8&libraries=geometry&sensor=false"></script>
        <script type="text/javascript" src="proj4.js"></script>
        <script type="text/javascript">
        var customIcons = [];

        var customIcons = {
            'MURDER': {
                icon: 'images/murder.png'
            },
            'THEFT': {
                icon: 'images/theft.png'
            },
            'ROBBERY': {
                icon: 'images/robbery.png'
            },
            'ORDINANCES': {
                icon: 'images/ordinances.png'
            },
            'CATTLERUSTLING': {
                icon: 'images/cattle.png'
            },
            'SPECIALLAWS': {
                icon: 'images/special-laws.png'
            },
            'HOMICIDE': {
                icon: 'images/homicide.png'
            },
            'CARNAPPING': {
                icon: 'images/carnapping.png'
            },
            'PHYSICALINJURIES': {
                icon: 'images/physical-injuries.png'
            },
            'RAPE': {
                icon: 'images/rape.png'
            },
            'OTHERNONINDEX': {
                icon: 'images/other.png'
            },
            'OTHERINCIDENTS': {
                icon: 'images/other-incidents.png'
            }
        };

    //var markerGroups = { "NON-INDEX CRIME": [], "INDEX CRIME": [], "OTHERINCIDENTS(Non Crime)": [], "ORDINANCE": []};
    //var markerGroups = { "MURDER": [], "THEFT": [], "ROBBERY": [], "ORDINANCES": [], "CATTLERUSTLING": [], "SPECIALLAWS": [], "HOMICIDE": [], "CARNAPPING": [], "PHYSICALINJURIES": [], "RAPE": [], "OTHERNONINDEX": [], "Sunday": [], "Monday": [], "Tuesday": [], "Wednesday": [], "Thursday": [], "Friday": [], "Saturday": [], "Adlawon": [], "Agsungot": [], "Apas": [], "Bacayan": [], "Banilad": [], "Binaliw": [], "Budla-an": [], "Busay": [], "Cambinocot": [], "Capitol Site": [], "Carreta": [], "Cogon Ramos": [], "Day-as": [], "Ermita": [], "Guba": [], "Hipodromo": []};
    var markerGroups = { "MURDER": [], "THEFT": [], "ROBBERY": [], "ORDINANCES": [], "CATTLERUSTLING": [], "SPECIALLAWS": [], "HOMICIDE": [], "CARNAPPING": [], "PHYSICALINJURIES": [], "RAPE": [], "OTHERNONINDEX": []};

    var markers = null;
    
    function load() {
        var map = new google.maps.Map(document.getElementById("map_canvas"), {
            center: new google.maps.LatLng(10.3216299, 123.9052633),
            zoom: 14,
            mapTypeId: 'roadmap'
        });


        var infowindow = new google.maps.InfoWindow();

        var customMapType = new google.maps.StyledMapType([            
        {
            "featureType": "administrative",
            "elementType": "labels.text.fill",
            "stylers": [
            {
                "color": "#444444"
            }
            ]
        },
        {
            "featureType": "landscape",
            "elementType": "all",
            "stylers": [
            {
                "color": "#f2f2f2"
            }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "all",
            "stylers": [
            {
                "visibility": "off"
            }
            ]
        },
        {
            "featureType": "road",
            "elementType": "all",
            "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 45
            }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "all",
            "stylers": [
            {
                "visibility": "simplified"
            }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "labels.icon",
            "stylers": [
            {
                "visibility": "off"
            }
            ]
        },
        {
            "featureType": "transit",
            "elementType": "all",
            "stylers": [
            {
                "visibility": "off"
            }
            ]
        },
        {
            "featureType": "water",
            "elementType": "geometry.fill",
            "stylers": [
            {
                "color": "#46bcec"
            },
            {
                "visibility": "on"
            }
            ]
        }
        ], {
          name: 'Custom Style'
      });

var customMapTypeId = 'custom_style';        

map.mapTypes.set(customMapTypeId, customMapType);
map.setMapTypeId(customMapTypeId);

      // Change this depending on the name of your PHP file
      downloadUrl("phpsqlajax_genxml.php", function(data) {
        var xml = data.responseXML;
        markers = xml.documentElement.getElementsByTagName("marker");
        console.log(markers)
        for (var i = 0; i < markers.length; i++) {
          var date = markers[i].getAttribute("date");
          var day = markers[i].getAttribute("day");
          var time = markers[i].getAttribute("time");
          var address = markers[i].getAttribute("areaofincident");
          var barangay = markers[i].getAttribute("barangay");
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("latitude")),
              parseFloat(markers[i].getAttribute("longitude")));
          var type = markers[i].getAttribute("crimetype");
          var crimecategory = markers[i].getAttribute("crimecategory");
          var crime = markers[i].getAttribute("classification");
          var html = "<b>" + crimecategory + "</b> <br/>" + crime + "</b> <br/>" + date + " " + time + "</b> <br/>" + barangay + "</b> <br/>" + address;
          var icon = customIcons[crimecategory] || {};
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon.icon,
            title: 'Click to show crime info'
        });
          

          
          console.log(crimecategory);
          
          //markerGroups[barangay].push(marker);
          
          bindInfoWindow(marker, map, infowindow, html);
      }
      markerGroups[crimecategory].push(marker);
      var markerCluster = new MarkerClusterer(map, marker);

  });
      console.log(marker);
      var counter = markers.length;
      console.log(counter);

  }
  console.log(counter);

  function show(category) {
    if (markerGroups.hasOwnProperty(category)) {
        var markersInCategory = markerGroups[category];
        for (var i=0; i<markersInCategory.length; i++) {
            markersInCategory[i].setVisible(true);
        }
    }
    
    console.log('something');
  }

  function hide(category) {
    if (markerGroups.hasOwnProperty(category)) {
        var markersInCategory = markerGroups[category];
        for (var i=0; i<markersInCategory.length; i++) {
            markersInCategory[i].setVisible(false);
        }
    }
    console.log('something');
  }

    hide("MURDER");
    hide("THEFT");
    hide("ROBBERY");
    hide("ORDINANCES");

  function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
      new ActiveXObject('Microsoft.XMLHTTP') :
      new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
      }
  };

  request.open('GET', url, true);
  request.send(null);
}

  

  function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
    });
  }



    function doNothing() {}

    </script>

</head>

<body onload="load()">

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <div class="navbar-brand">
                    <img src="images/logo-small.png" class="center-block" alt="Logo Small">
                </div>
            </div>
            <div class="navbar-clock">
                <span id="date_time"></span>
                <script type="text/javascript">window.onload = date_time('date_time');</script>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 2</strong>
                                        <span class="pull-right text-muted">20% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">80% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            <div class="picker-sidebar" style="position: absolute">
                <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                    <span></span> <b class="caret"></b>
                </div>
            </div>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="heading">
                            <h4>CCPO FUNCTION</h4>
                        </li>
                        <li class="sidebar-upload">
                            <div class="btn-group btn-group-justified">
                                <a href="daily.html" class="btn btn-primary" id="prediction" role="button">Prediction</a>
                                <a href="reporting.php" class="btn btn-primary active" id="reporting" role="button">Reporting</a>
                            </div>
                        </li>
                        <!--
                        <li class="heading">
                            <h4>BULK ENTRY</h4>
                        </li>                   
                        <li class="sidebar-upload">
                            <div class="input-group-reporting">
                                <span class="input-group-btn">
                                    <span class="btn btn-primary btn-file">
                                        Browse&hellip; <input type="file" id="csv" name="csv">
                                    </span>
                                </span>
                                <input type="text" class="form-control" readonly>
                            </div>
                        </li>-->
                        <li class="heading">
                            <h4>MANUAL ENTRY</h4>
                        </li>       
                        <li>
                            <a href="#form-entry" data-toggle="modal" class="btn btn-md btn-primary" id="prediction" role="button">New Crime Entry</a>
                        </li>
                        <li class="heading">
                            <h4>FILTERS</h4>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-list fa-fw"></i> Crime Type<span class="fa arrow rotate"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <div class="filters">
                                        <label class="control-label " for="crimefilter">
                                            <input class="checkbox" id="MURDER" name="MURDER" type="checkbox" value="MURDER"> MURDER
                                        </label>
                                    </div>
                                    <div class="filters">
                                        <label class="control-label " for="crimefilter">
                                            <input class="checkbox" id="THEFT" name="THEFT" type="checkbox" value="THEFT"> THEFT
                                        </label>
                                    </div>
                                    <div class="filters">
                                        <label class="control-label " for="crimefilter">
                                            <input class="checkbox" id="ROBBERY" name="ROBBERY" type="checkbox" value="ROBBERY" > ROBBERY
                                        </label>
                                    </div>
                                    <div class="filters">
                                        <label class="control-label " for="crimefilter">
                                            <input class="checkbox" id="ORDINANCES" name="ORDINANCES" type="checkbox" value="ORDINANCES" > ORDINANCES
                                        </label>
                                    </div>
                                    <div class="filters">
                                        <label class="control-label " for="crimefilter">
                                            <input class="checkbox" id="CATTLERUSTLING" name="CATTLERUSTLING" type="checkbox" value="CATTLERUSTLING"> CATTLE RUSTLING
                                        </label>
                                    </div>
                                    <div class="filters">
                                        <label class="control-label " for="crimefilter">
                                            <input class="checkbox" id="SPECIALLAWS" name="SPECIALLAWS" type="checkbox" value="SPECIALLAWS"> SPECIAL LAWS
                                        </label>
                                    </div>
                                    <div class="filters">
                                        <label class="control-label " for="crimefilter">
                                            <input class="checkbox" id="HOMICIDE" name="HOMICIDE" type="checkbox" value="HOMICIDE"> HOMICIDE
                                        </label>
                                    </div>
                                    <div class="filters">
                                        <label class="control-label " for="crimefilter">
                                            <input class="checkbox" id="CARNAPPING" name="CARNAPPING" type="checkbox" value="CARNAPPING"> CARNAPPING
                                        </label>
                                    </div>
                                    <div class="filters">
                                        <label class="control-label " for="crimefilter">
                                            <input class="checkbox" id="PHYSICALINJURIES" name="PHYSICALINJURIES" type="checkbox" value="PHYSICALINJURIES"> PHYSICAL INJURIES
                                        </label>
                                    </div>
                                    <div class="filters">
                                        <label class="control-label " for="crimefilter">
                                            <input class="checkbox" id="RAPE" name="RAPE" type="checkbox" value="RAPE"> RAPE
                                        </label>
                                    </div>
                                    <div class="filters">
                                        <label class="control-label " for="crimefilter">
                                            <input class="checkbox" id="OTHERNONINDEX" name="OTHERNONINDEX" type="checkbox" value="OTHERNONINDEX"> OTHER NON-INDEX
                                        </label>
                                    </div>
                                </li>
                            </ul>                          
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-calendar fa-fw"></i> Day<span class="fa arrow rotate"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <div class="filters">
                                        <label class="control-label " for="dayfilter">
                                            <input class="checkbox" id="Sunday" name="Sunday" type="checkbox" value="Sunday"> SUNDAY
                                        </label>
                                    </div>
                                    <div class="filters">
                                        <label class="control-label " for="dayfilter">
                                            <input class="checkbox" id="Monday" name="Monday" type="checkbox" value="Monday"> MONDAY
                                        </label>
                                    </div>
                                    <div class="filters">
                                        <label class="control-label " for="dayfilter">
                                            <input class="checkbox" id="Tuesday" name="Tuesday" type="checkbox" value="Tuesday"> TUESDAY
                                        </label>
                                    </div>
                                    <div class="filters">
                                        <label class="control-label " for="dayfilter">
                                            <input class="checkbox" id="Wednesday" name="Wednesday" type="checkbox" value="Wednesday"> WEDNESDAY
                                        </label>
                                    </div>
                                    <div class="filters">
                                        <label class="control-label " for="dayfilter">
                                            <input class="checkbox" id="Thursday" name="Thursday" type="checkbox" value="Thursday"> THURSDAY
                                        </label>
                                    </div>
                                    <div class="filters">
                                        <label class="control-label " for="dayfilter">
                                            <input class="checkbox" id="Friday" name="Friday" type="checkbox" value="Friday"> FRIDAY
                                        </label>
                                    </div>
                                    <div class="filters">
                                        <label class="control-label " for="dayfilter">
                                            <input class="checkbox" id="Saturday" name="Saturday" type="checkbox" value="Saturday"> SATURDAY
                                        </label>
                                    </div>
                                </li>
                            </ul>                          
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-map-marker fa-fw"></i> Barangay<span class="fa arrow rotate"></span></a>
                            <ul class="nav nav-second-level">
                                <div class="form-group" id="barangay-selector">
                                  <select class="form-control" id="selector">
                                    <option>Choose barangay</option>
                                    <option name="Capitol Site" value="Capitol Site">Capitol Site</option>
                                    <option name="Apas" value="Apas">Apas</option>
                                    <option>3</option>
                                    <option>4</option>
                                </select>
                            </div>
                            </ul>                          
                        </li>
                        <!-- /.nav-second-level -->
                        <!-- /.
                        <li>
                            <a href="#"><i class="fa fa-map-marker fa-fw"></i> Filter Location<span class="fa arrow rotate"></span></a>
                            <ul class="nav nav-second-level">
                                <li class="sidebar-search">
                                    <div class="input-group custom-search-form">
                                        <input type="text" class="form-control" placeholder="Enter Location">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </li>
                            </ul>
                        </li> -->
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper-reporting">
            <div id="map_canvas" style="width:100%; height: 100%"></div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <div class="modal fade" id="form-entry" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>New Crime Entry</h3>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <form action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="modal-subheader">
                            <h4>General Info</h4>
                        </div>
                        <div class="form-group col-md-4">
                            <!--<small class="text-danger">* <?php echo $dateError; ?></small>-->
                            <label class="control-label " for="encoder">Encoder</label>
                            <input class="form-control" id="encoder" name="encoder" placeholder="P01 Juan Dela Cruz" type="text"/>
                        </div>
                        <div class="form-group col-md-4">
                            <!--<small class="text-danger">* <?php echo $dateError; ?></small>-->
                            <label class="control-label " for="source">Source</label>
                            <select class="form-control" id="selector">
                                <option value="">Choose Source</option>
                                <option name="Blotter" value="Blotter">Blotter</option>
                                <option name="WCPD Blotter" value="WCPD Blotter">WCPD Blotter</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4" id="datepicker">
                            <!--<small class="text-danger">* <?php echo $dateError; ?></small>-->
                            <label class="control-label " for="datereptd">Date Reported</label>
                            <input class="form-control" id="datereptd" name="datereptd" placeholder="MM/DD/YYYY" type="text"/>
                        </div>
                        <div class="form-group col-md-4">
                            <!--<small class="text-danger">* <?php echo $dateError; ?></small>-->
                            <label class="control-label " for="datecomtd">Date Committed</label>
                            <input class="form-control" id="date" name="date" placeholder="MM/DD/YYYY" type="text"/>
                        </div>
                        <div class="form-group col-md-4">
                            <!--<small class="text-danger">* <?php echo $dayError; ?></small>-->
                            <label class="control-label " for="daycomtd">Day Committed</label>
                            <!--<input class="form-control" id="day" name="day" placeholder='i.e. "Monday"' type="text"/>-->
                            <select class="form-control" id="selector">
                                <option value="">Choose Day</option>
                                <option name="Sunday" value="Sunday">Sunday</option>
                                <option name="Monday" value="Monday">Monday</option>
                                <option name="Tuesday" value="Tuesday">Tuesday</option>
                                <option name="Wednesday" value="Wednesday">Wednesday</option>
                                <option name="Thursday" value="Thursday">Thursday</option>
                                <option name="Friday" value="Friday">Friday</option>
                                <option name="Saturday" value="Saturday">Saturday</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <!--<small class="text-danger">* <?php echo $timeError; ?></small>-->
                            <label class="control-label " for="timecomtd">Time Committed</label>
                            <input class="form-control" id="time" name="time" placeholder='i.e. "11:00 AM"' type="text"/>
                        </div>
                        <div class="form-group col-md-2">
                            <!--<small class="text-danger">* <?php echo $timeError; ?></small>-->
                            <label class="control-label " for="entryno">Entry No.</label>
                            <input class="form-control" id="entryno" name="entryno" placeholder="0123" type="text"/>
                        </div>
                        <div class="form-group col-md-2">
                            <!--<small class="text-danger">* <?php echo $timeError; ?></small>-->
                            <label class="control-label " for="ppo">PPO</label>
                            <!--<input class="form-control" id="ppo" name="ppo" placeholder="CEBU_CITY" type="text"/>-->
                            <select class="form-control" id="selector">
                                <option value="">Choose PPO</option>
                                <option name="BOHOL" value="BOHOL">BOHOL</option>
                                <option name="CEBU" value="CEBU">CEBU</option>
                                <option name="CEBU_CITY" value="CEBU_CITY">CEBU_CITY</option>
                                <option name="LAPULAPU_CITY" value="LAPULAPU_CITY">LAPULAPU_CITY</option>
                                <option name="MANDAUE_CITY" value="MANDAUE_CITY">MANDAUE_CITY</option>
                                <option name="NEGROS_ORIENTAL" value="NEGROS_ORIENTAL">NEGROS_ORIENTAL</option>
                                <option name="SIQUIJOR_PROV" value="SIQUIJOR_PROV">SIGUIJOR_PROV</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <!--<small class="text-danger">* <?php echo $areaofincidentError; ?></small>-->
                            <label class="control-label " for="unitstation">Unit/Station</label>
                            <!--<input class="form-control" id="unitstation" name="unitstation" placeholder='i.e. "STATION1_PARIAN"' type="text"/>-->
                            <select class="form-control" id="selector">
                                <option value="">Choose UNIT/STATION</option>
                                <option name="STATION1_CENTRO" value="STATION1_CENTRO">STATION1_CENTRO</option>
                                <option name="STATION2_SUBANGDAKU" value="STATION2_SUBANGDAKU">STATION2_SUBANGDAKU</option>
                                <option name="STATION3_BASAK" value="STATION3_BASAK">STATION3_BASAK</option>
                                <option name="STATION4_CASUNTINGAN" value="STATION4_CASUNTINGAN">STATION4_CASUNTINGAN</option>
                                <option name="STATION5_OPAO" value="STATION5_OPAO">STATION5_OPAO</option>
                                <option name="STATION6_CANDUMAN" value="STATION6_CANDUMAN">STATION6_CANDUMAN</option>
                                <option name="MCPO_WCPD" value="MCPO_WCPD">MCPO_WCPD</option>
                                <option name="MCPO_TRS" value="MCPO_TRS">MCPO_TRS</option>
                                <option name="MCPO_HOMICIDE" value="MCPO_HOMICIDE">MCPO_HOMICIDE</option>
                                <option name="MCPO_TPU" value="MCPO_TPU">MCPO_TPU</option>
                                <option name="MCPO_CIB" value="MCPO_CIB">MCPO_CIB</option>
                                <option name="MCPO_IDMB" value="MCPO_IDMB">MCPO_IDMB</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <!--<small class="text-danger">* <?php echo $areaofincidentError; ?></small>-->
                            <label class="control-label " for="areaofincident">Area of Incident</label>
                            <!--<input class="form-control" id="areaofincident" name="areaofincident" placeholder='i.e. "STATION1_PARIAN"' type="text"/>-->
                            <select class="form-control" id="selector">
                                <option value="">Choose Day</option>
                                <option name="Sunday" value="Sunday">Sunday</option>
                                <option name="Monday" value="Monday">Monday</option>
                                <option name="Tuesday" value="Tuesday">Tuesday</option>
                                <option name="Wednesday" value="Wednesday">Wednesday</option>
                                <option name="Thursday" value="Thursday">Thursday</option>
                                <option name="Friday" value="Friday">Friday</option>
                                <option name="Saturday" value="Saturday">Saturday</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <!--<small class="text-danger">* <?php echo $barangayError; ?></small>-->
                            <label class="control-label " for="barangay">Barangay</label>
                            <input class="form-control" id="barangay" name="barangay" placeholder='i.e. "Pasil," "Tisa"' type="text"/>
                        </div>
                        <div class="form-group col-md-8">
                            <!--<small class="text-danger">* <?php echo $streetError; ?></small>-->
                            <label class="control-label " for="street">Building/House No/Street/Sitio</label>
                            <input class="form-control" id="street" name="street" type="text"/>
                        </div>
                        <div class="form-group col-md-2">
                            <!--<small class="text-danger">* <?php echo $latitudeError; ?></small>-->
                            <label class="control-label " for="latitude">Latitudinal Coordinates (X)</label>
                            <input class="form-control" id="latitude" name="latitude" type="text"/>
                        </div>
                        <div class="form-group col-md-2">
                            <!--<small class="text-danger">* <?php echo $longitudeError; ?></small>-->
                            <label class="control-label " for="longitude">Longitudinal Coordinates (Y)</label>
                            <input class="form-control" id="longitude" name="longitude" type="text"/>
                        </div>
                        <div class="form-group col-md-2">
                            <div>
                                <a href="#map-picker" data-toggle="modal" class="btn btn-md btn-primary" id="prediction" role="button">Open Map</a>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <!--<small class="text-danger">* <?php echo $crimetypeError; ?></small>-->
                            <label class="control-label " for="crimetype">Crime Type</label>
                            <input class="form-control" id="crimetype" name="crimetype" placeholder='i.e. "NON-INDEX CRIME"' type="text"/>
                        </div>
                        <div class="form-group col-md-6">
                            <!--<small class="text-danger">* <?php echo $indexcrimetypeError; ?></small>-->
                            <label class="control-label " for="indexcrimetype">Index Crime Type</label>
                            <input class="form-control" id="indexcrimetype" name="indexcrimetype" type="text"/>
                        </div>
                        <div class="form-group col-md-6">
                            <!--<small class="text-danger">* <?php echo $crimecategoryError; ?></small>-->
                            <label class="control-label " for="crimecategory">Crime Category</label>
                            <input class="form-control" id="crimecategory" name="crimecategory" placeholder='i.e. "OTHERNONINDEX"' type="text"/>
                        </div>
                        <div class="form-group col-md-8">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="classification">Classification</label>
                            <input class="form-control" id="classification" name="classification" type="text"/>
                        </div>
                        <div class="form-group col-md-4">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="modeofcommission">Mode of Commission</label>
                            <input class="form-control" id="modeofcommission" name="modeofcommission" type="text"/>
                        </div>
                        <div class="form-group col-md-4">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="streetcrime">Street Crime</label>
                            <input class="form-control" id="streetcrime" name="streetcrime" type="text"/>
                        </div>
                        <div class="form-group col-md-4">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="involveminor">Involve Minor?</label>
                            <input class="form-control" id="involveminor" name="involveminor" type="text"/>
                        </div>
                        <div class="form-group col-md-4">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="specialcase">Special Case</label>
                            <input class="form-control" id="specialcase" name="specialcase" type="text"/>
                        </div>
                        <div class="modal-subheader">
                            <h4>Weapon Info</h4>
                        </div>
                        <div class="form-group col-md-4">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="weaponused">Weapon(s) Used</label>
                            <input class="form-control" id="weaponused" name="weaponused" type="text"/>
                        </div>
                        <div class="form-group col-md-4">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="facaliber">Firearm Caliber</label>
                            <input class="form-control" id="facaliber" name="facaliber" type="text"/>
                        </div>
                        <div class="form-group col-md-4">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="fastatus">Firearm Status</label>
                            <input class="form-control" id="fastatus" name="fastatus" type="text"/>
                        </div>
                        <div class="form-group col-md-4">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="falicenseno">Firearm License Number</label>
                            <input class="form-control" id="falicenseno" name="falicenseno" type="text"/>
                        </div>
                        <div class="form-group col-md-4">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="crsfirearms">C-R-S Firearms</label>
                            <input class="form-control" id="crsfirearms" name="crsfirearms" type="text"/>
                        </div>
                        <div class="form-group col-md-4">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="fadisposition">Firearm Disposition</label>
                            <input class="form-control" id="fadisposition" name="fadisposition" type="text"/>
                        </div>
                        <div class="modal-subheader">
                            <h4>Transportation Info</h4>
                        </div>
                        <div class="form-group col-md-4">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="transport">Transport</label>
                            <input class="form-control" id="transport" name="transport" type="text"/>
                        </div>
                        <div class="form-group col-md-4">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="motorcycleridingcriminals">Motorcycle Riding Criminals</label>
                            <input class="form-control" id="motorcycleridingcriminals" name="motorcycleridingcriminals" type="text"/>
                        </div>
                        <div class="form-group col-md-4">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="driversuspect">Driver Suspect</label>
                            <input class="form-control" id="driversuspect" name="driversuspect" type="text"/>
                        </div>
                        <div class="form-group col-md-4">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="vehowner">Vehicle Owner</label>
                            <input class="form-control" id="vehowner" name="vehowner" type="text"/>
                        </div>
                        <div class="form-group col-md-4">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="vehtype">Vehicle Type</label>
                            <input class="form-control" id="vehtype" name="vehtype" type="text"/>
                        </div>
                        <div class="form-group col-md-4">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="vehplatenum">Vehicle Plate Number</label>
                            <input class="form-control" id="vehplatenum" name="vehplatenum" type="text"/>
                        </div>
                        <div class="modal-subheader">
                            <h4>Drug Use Info</h4>
                        </div>
                        <div class="form-group col-md-6">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="drugs">Drugs</label>
                            <input class="form-control" id="drugs" name="drugs" type="text"/>
                        </div>
                        <div class="form-group col-md-6">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="drugconfiscateditem">Drug Confiscated Item</label>
                            <input class="form-control" id="drugconfiscateditem" name="drugconfiscateditem" type="text"/>
                        </div>
                        <div class="modal-subheader">
                            <h4>Gambling Info</h4>
                        </div>
                        <div class="form-group col-md-4">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="gambling">Gambling</label>
                            <input class="form-control" id="gambling" name="gambling" type="text"/>
                        </div>
                        <div class="form-group col-md-4">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="gamblingconfiscateditem">Gambling Confiscated Item</label>
                            <input class="form-control" id="gamblingconfiscateditem" name="gamblingconfiscateditem" type="text"/>
                        </div>
                        <div class="form-group col-md-4">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="gamblingamountconfiscated">Gambling Amount Confiscated</label>
                            <input class="form-control" id="gamblingamountconfiscated" name="gamblingamountconfiscated" type="text"/>
                        </div>
                        <div class="modal-subheader">
                            <h4>Carnapping Info</h4>
                        </div>
                        <div class="form-group col-md-12">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="rec_unrec">Recovered/Unrecovered</label>
                            <input class="form-control" id="rec_unrec" name="rec_unrec" type="text"/>
                        </div>
                        <div class="modal-subheader">
                            <h4>Robbery Info</h4>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="robberytype">Robbery Type</label>
                            <input class="form-control" id="robberytype" name="robberytype" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="bankrobberyamount">Bank Robbery Amount</label>
                            <input class="form-control" id="bankrobberyamount" name="bankrobberyamount" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="establishmenttype">Establishment Type</label>
                            <input class="form-control" id="establishmenttype" name="establishmenttype" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="establishmentname">Establishment Name</label>
                            <input class="form-control" id="establishmentname" name="establishmentname" type="text"/>
                        </div>
                        <div class="modal-subheader">
                            <h4>Case Info</h4>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="casestatus">Case Status</label>
                            <input class="form-control" id="casestatus" name="casestatus" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="solved">Solved?</label>
                            <input class="form-control" id="solved" name="solved" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="cleared">Cleared?</label>
                            <input class="form-control" id="cleared" name="cleared" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="uncleared_unsolved">Uncleared/Unsolved</label>
                            <input class="form-control" id="uncleared_unsolved" name="uncleared_unsolved" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="arrest">Arrest</label>
                            <input class="form-control" id="arrest" name="arrest" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="numarrested">No. of Arrested Suspect(s)</label>
                            <input class="form-control" id="numarrested" name="numarrested" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="datefiled">Date Filed</label>
                            <input class="form-control" id="datefiled" name="datefiled" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="iscasenum">IS/Case Number</label>
                            <input class="form-control" id="iscasenum" name="iscasenum" type="text"/>
                        </div>
                        <div class="modal-subheader">
                            <h4>Victim Info</h4>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="numvictim">Number of Victims</label>
                            <input class="form-control" id="numvictim" name="numvictim" type="text"/>
                        </div>
                        <div class="form-group col-md-6">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="namevictim">Victim Name</label>
                            <input class="form-control" id="namevictim" name="namevictim" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="addressvictim">Victim Address</label>
                            <input class="form-control" id="addressvictim" name="addressvictim" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="victimoccupation">Victim Occupation</label>
                            <input class="form-control" id="victimoccupation" name="victimoccupation" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="victimoccupationagency">Victim Occupation Agency</label>
                            <input class="form-control" id="victimoccupationagency" name="victimoccupationagency" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="victimage">Victim Age</label>
                            <input class="form-control" id="victimage" name="victimage" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="victimagegroup">Victim Age Group</label>
                            <input class="form-control" id="victimagegroup" name="victimagegroup" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="victimsex">Victim Sex</label>
                            <input class="form-control" id="victimsex" name="victimsex" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="victimcs">Victim Civil Status</label>
                            <input class="form-control" id="victimcs" name="victimcs" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="victimtourist">Victim a Tourist?</label>
                            <input class="form-control" id="victimtourist" name="victimtourist" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="victimnationality">Victim Nationality</label>
                            <input class="form-control" id="victimnationality" name="victimnationality" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="victimethnicity">Victim Ethnicity</label>
                            <input class="form-control" id="victimethnicity" name="victimethnicity" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="victimdefect">Victim Defect</label>
                            <input class="form-control" id="victimdefect" name="victimdefect" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="victimstatus">Victim Status</label>
                            <input class="form-control" id="victimstatus" name="victimstatus" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="victimdrugalcohol">Victim Drug/Alcohol Use</label>
                            <input class="form-control" id="victimdrugalcohol" name="victimdrugalcohol" type="text"/>
                        </div>
                        <div class="modal-subheader">
                            <h4>Suspect Info</h4>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="numsuspect">Number of Suspect(s)</label>
                            <input class="form-control" id="numsuspect" name="numsuspect" type="text"/>
                        </div>
                        <div class="form-group col-md-6">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="namesuspect">Suspect Name</label>
                            <input class="form-control" id="namesuspect" name="namesuspect" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="addresssuspect">Suspect Address</label>
                            <input class="form-control" id="addresssuspect" name="addresssuspect" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="suspectbirthplace">Victim Birthplace</label>
                            <input class="form-control" id="suspectbirthplace" name="suspectbirthplace" type="text"/>
                        </div>
                        <div class="form-group col-md-6">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="suspectdistinctmark">Suspect Distinct Mark</label>
                            <input class="form-control" id="suspectdistinctmark" name="suspectdistinctmark" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="suspectsex">Suspect Sex</label>
                            <input class="form-control" id="suspectsex" name="suspectsex" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="suspectcs">Suspect Civil Status</label>
                            <input class="form-control" id="suspectcs" name="suspectcs" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="suspectheight">Suspect Height</label>
                            <input class="form-control" id="suspectheight" name="suspectheight" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="suspectweight">Suspect Weight</label>
                            <input class="form-control" id="suspectweight" name="suspectweight" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="suspectbday">Suspect Birth Date</label>
                            <input class="form-control" id="suspectbday" name="suspectbday" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="suspectage">Suspect Age</label>
                            <input class="form-control" id="suspectage" name="suspectage" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="suspecthaircolor">Suspect Hair Color</label>
                            <input class="form-control" id="suspecthaircolor" name="suspecthaircolor" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="suspectoccupation">Suspect Occupation</label>
                            <input class="form-control" id="suspectoccupation" name="suspectoccupation" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="suspectoccupationagency">Suspect Occupation Agency</label>
                            <input class="form-control" id="suspectoccupationagency" name="suspectoccupationagency" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="suspectnationality">Suspect Nationality</label>
                            <input class="form-control" id="suspectnationality" name="suspectnationality" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="suspectethnicity">Suspect Ethnicity</label>
                            <input class="form-control" id="suspectethnicity" name="suspectethnicity" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="suspectforeigner">Suspect a Foreigner?</label>
                            <input class="form-control" id="suspectforeigner" name="suspectforeigner" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="suspectgang">Suspect Gang</label>
                            <input class="form-control" id="suspectgang" name="suspectgang" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="suspectprevcriminal">Suspect Previous Criminal</label>
                            <input class="form-control" id="suspectprevcriminal" name="suspectprevcriminal" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="suspectpnpmember">Suspect PNP Member</label>
                            <input class="form-control" id="suspectpnpmember" name="suspectpnpmember" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="suspectdrugalcohol">Suspect Drug/Alcohol Use</label>
                            <input class="form-control" id="suspectdrugalcohol" name="suspectdrugalcohol" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="suspectdisposition">Suspect Disposition</label>
                            <input class="form-control" id="suspectdisposition" name="suspectdisposition" type="text"/>
                        </div>
                        <div class="modal-subheader">
                            <h4>Entry Info</h4>
                        </div>
                        <div class="form-group col-md-4">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="investigator">Investigator</label>
                            <input class="form-control" id="investigator" name="investigator" type="text"/>
                        </div>
                        <div class="form-group col-md-8">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="narrative">Narrative</label>
                            <input class="form-control" id="narrative" name="narrative" type="text"/>
                        </div>
                        <div class="form-group col-md-12">
                            <!--<small class="text-danger">* <?php echo $classificationError; ?></small>-->
                            <label class="control-label " for="progressreport">Progress Report</label>
                            <input class="form-control" id="progressreport" name="progressreport" type="text"/>
                        </div>
                        <div class="form-group">
                            <div>
                                <input style="display:none" type="text"/>
                                <button class="btn btn-primary btn-lg" name="submit" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- End of Crime Entry modal -->

    <div class="modal fade" id="map-picker" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="container-fluid">
                    <div class="row">
                        <div id="map_canvas" style="width:600px; height: 400px; position: relative"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>



<!-- Metis Menu Plugin JavaScript -->
<script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="../bower_components/raphael/raphael-min.js"></script>
<script src="../bower_components/morrisjs/morris.min.js"></script>
<script src="../js/morris-data.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>
<script src="../dist/js/highlight.js"></script>
<script src="../dist/js/main.js"></script>


<script>
$('.fa.arrow').on('click', function() {
    $(this).closest('a').next('.nav').slideToggle();
});
</script>

<script>
$(".rotate").click(function(){
    $(this).toggleClass("down")  ; 
})
</script>

<script type="text/javascript">
$(".checkbox").click(function(){
    var cat = $(this).attr("value");    
            // If checked
            if ($(this).is(":checked"))
            {
                show(cat);
            }
            else
            {
                hide(cat);
            }
        });
</script>



<script type="text/javascript">
$(function() {

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }
    cb(moment().subtract(29, 'days'), moment());

    $('#reportrange').daterangepicker({
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

});
</script>


</body>
</html>