<?php

namespace Zenweb\Aventure\ParcBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

//use Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder;
use Zenweb\Aventure\ParcBundle\Form\CreateOrder;
use Zenweb\Aventure\ParcBundle\Entity\Group;

define ("CMCIC_CLE", "12345678901234567890123456789012345678P0");
define ("CMCIC_TPE", "0000001");
define ("CMCIC_VERSION", "3.0");
define ("CMCIC_SERVEUR", "https://ssl.paiement.cic-banques.fr/test/");
define ("CMCIC_CODESOCIETE", "TEST");
define ("CMCIC_URLOK", "http://accro.fiducial.dom/payment/success");
define ("CMCIC_URLKO", "http://accro.fiducial.dom/payment/error");
define("CMCIC_CTLHMAC","V1.04.sha1.php--[CtlHmac%s%s]-%s");
define("CMCIC_CTLHMACSTR", "CtlHmac%s%s");
define("CMCIC_CGI2_RECEIPT","version=2\ncdr=%s");
define("CMCIC_CGI2_MACOK","0");
define("CMCIC_CGI2_MACNOTOK","1\n");
define("CMCIC_CGI2_FIELDS", "%s*%s*%s*%s*%s*%s*%s*%s*%s*%s*%s*%s*%s*%s*%s*%s*%s*%s*%s*%s*");
define("CMCIC_CGI1_FIELDS", "%s*%s*%s%s*%s*%s*%s*%s*%s*%s*%s*%s*%s*%s*%s*%s*%s*%s*%s*%s");
define("CMCIC_URLPAIEMENT", "paiement.cgi");

class OrderController extends Controller
{
    public function createOrderAction()
    {
        $formData = new CreateOrder();
        $formPayment = null;
        /** @var $flow \Zenweb\Aventure\ParcBundle\Form\Admin\CreateOrderFlow */
        $flow = $this->get('zenweb_aventure_parc.form.admin.flow.create.order');
        $flow->bind($formData);

        // form of the current step
        $form = $flow->createForm();

        $parc = 0;
        $typicalDayId = 0;

        if ($flow->getCurrentStepNumber() > 1) {
            $parc = $flow->getFormData()->order->getParc()->getId();
        }

        if ($flow->isValid($form)) {
            $flow->saveCurrentStepData($form);

            /**
             * Needed for calendars
             */
            if ($flow->getCurrentStepNumber() >= 1) {
                $parc = $flow->getFormData()->order->getParc()->getId();
            }

            if ($flow->getCurrentStepNumber() >= 8) {
                // TPE Settings
// Warning !! CMCIC_Config contains the key, you have to protect this file with all the mechanism available in your development environment.
// You may for instance put this file in another directory and/or change its name. If so, don't forget to adapt the include path below.
                //include_once("CMCIC_Config.php");


// PHP implementation of RFC2104 hmac sha1 ---
                //include_once("CMCIC_Tpe.inc.php");
/*****************************************************************************
 *
 * "open source" kit for CMCIC-P@iement(TM)
 *
 * File "CMCIC_Tpe.inc.php":
 *
 * Author   : Euro-Information/e-Commerce (contact: centrecom@e-i.com)
 * Version  : 1.04
 * Date     : 01/01/2009
 *
 * Copyright: (c) 2009 Euro-Information. All rights reserved.
 * License  : see attached document "License.txt".
 *
 *****************************************************************************/






                $sOptions = "";

// ----------------------------------------------------------------------------
//  CheckOut Stub setting fictious Merchant and Order datas.
//  That's your job to set actual order fields. Here is a stub.
// -----------------------------------------------------------------------------

// Reference: unique, alphaNum (A-Z a-z 0-9), 12 characters max
                $sReference = "ref" . date("His");

// Amount : format  "xxxxx.yy" (no spaces)
                $sMontant = 1.01;

// Currency : ISO 4217 compliant
                $sDevise  = "EUR";

// free texte : a bigger reference, session context for the return on the merchant website
                $sTexteLibre = "Texte Libre";

// transaction date : format d/m/y:h:m:s
                $sDate = date("d/m/Y:H:i:s");

// Language of the company code
                $sLangue = "FR";

// customer email
                $sEmail = "test@test.zz";

// ----------------------------------------------------------------------------

// between 2 and 4
//$sNbrEch = "4";
                $sNbrEch = "";

// date echeance 1 - format dd/mm/yyyy
//$sDateEcheance1 = date("d/m/Y");
                $sDateEcheance1 = "";

// montant échéance 1 - format  "xxxxx.yy" (no spaces)
//$sMontantEcheance1 = "0.26" . $sDevise;
                $sMontantEcheance1 = "";

// date echeance 2 - format dd/mm/yyyy
                $sDateEcheance2 = "";

// montant échéance 2 - format  "xxxxx.yy" (no spaces)
//$sMontantEcheance2 = "0.25" . $sDevise;
                $sMontantEcheance2 = "";

// date echeance 3 - format dd/mm/yyyy
                $sDateEcheance3 = "";

// montant échéance 3 - format  "xxxxx.yy" (no spaces)
//$sMontantEcheance3 = "0.25" . $sDevise;
                $sMontantEcheance3 = "";

// date echeance 4 - format dd/mm/yyyy
                $sDateEcheance4 = "";

// montant échéance 4 - format  "xxxxx.yy" (no spaces)
//$sMontantEcheance4 = "0.25" . $sDevise;
                $sMontantEcheance4 = "";

// ----------------------------------------------------------------------------

                $oTpe = new CMCIC_Tpe($sLangue);
                $oHmac = new CMCIC_Hmac($oTpe);

// Control String for support
                $CtlHmac = sprintf(CMCIC_CTLHMAC, $oTpe->sVersion, $oTpe->sNumero, $oHmac->computeHmac(sprintf(CMCIC_CTLHMACSTR, $oTpe->sVersion, $oTpe->sNumero)));

// Data to certify
                $PHP1_FIELDS = sprintf(CMCIC_CGI1_FIELDS,     $oTpe->sNumero,
                    $sDate,
                    $sMontant,
                    $sDevise,
                    $sReference,
                    $sTexteLibre,
                    $oTpe->sVersion,
                    $oTpe->sLangue,
                    $oTpe->sCodeSociete,
                    $sEmail,
                    $sNbrEch,
                    $sDateEcheance1,
                    $sMontantEcheance1,
                    $sDateEcheance2,
                    $sMontantEcheance2,
                    $sDateEcheance3,
                    $sMontantEcheance3,
                    $sDateEcheance4,
                    $sMontantEcheance4,
                    $sOptions);

// MAC computation
                $sMAC = $oHmac->computeHmac($PHP1_FIELDS);
                $formPayment='<form action="'.$oTpe->sUrlPaiement.'" method="post" id="PaymentRequest">';
                $formPayment.='<p>';
                $formPayment.='<input type="hidden" name="version"             id="version"        value="'.$oTpe->sVersion.'" />';
                $formPayment.='<input type="hidden" name="TPE"                 id="TPE"            value="'.$oTpe->sNumero.'" />';
                $formPayment.='<input type="hidden" name="date"                id="date"           value="'.$sDate.'" />';
                $formPayment.='<input type="hidden" name="montant"             id="montant"        value="'.$sMontant . $sDevise.'" />';
                $formPayment.='<input type="hidden" name="reference"           id="reference"      value="'.$sReference.'" />';
                $formPayment.='<input type="hidden" name="MAC"                 id="MAC"            value="'.$sMAC.'" />';
                $formPayment.='<input type="hidden" name="url_retour"          id="url_retour"     value="'.$oTpe->sUrlKO.'" />';
                $formPayment.='<input type="hidden" name="url_retour_ok"       id="url_retour_ok"  value="'.$oTpe->sUrlOK.'" />';
                $formPayment.='<input type="hidden" name="url_retour_err"      id="url_retour_err" value="'.$oTpe->sUrlKO.'" />';
                $formPayment.='<input type="hidden" name="lgue"                id="lgue"           value="'.$oTpe->sLangue.'" />';
                $formPayment.='<input type="hidden" name="societe"             id="societe"        value="'.$oTpe->sCodeSociete.'" />';
                $formPayment.='<input type="hidden" name="texte-libre"         id="texte-libre"    value="'.HtmlEncode($sTexteLibre).'" />';
                $formPayment.='<input type="hidden" name="mail"                id="mail"           value="'.$sEmail.'" />';
                $formPayment.='<input type="submit" name="bouton"              id="bouton"         value="Connexion / Connection" />';
                $formPayment.='</p>';
                $formPayment.='</form>';
            }
            if ($flow->nextStep()) {
                /**
                 * We have choose a date and a parc, get the typicalDayId needed for other purpose.
                 */

                if ($flow->getCurrentStepNumber() > 2) {
                    $date = $flow->getFormData()->order->getBookingDate();
                    $em   = $this->getDoctrine()->getManager()->getRepository('ZenwebAventureParcBundle:Booking');
                    $flow->getFormData()->order->setBooking($em->findOneBy(array('theDate' => $date, 'parc' => $parc)));
                    $typicalDayId = $flow->getFormData()->order->getBooking()->getTypicalDay()->getId();
                }
                // form for the next step
                $form = $flow->createForm();
            } else {
                // flow finished
                $em = $this->getDoctrine()->getManager();
                $em->persist($formData->order);
                $em->flush();

                $flow->reset(); // remove step data from the session

                return $this->redirect($this->generateUrl('sonata_admin_dashboard')); // redirect when done
            }
        }

        $userId = (!empty($formData->order->getUser()) && !empty($formData->order->getUser()->getId())) ? $formData->order->getUser()->getId() : -1;

        return $this->render('ZenwebAventureParcBundle:Admin:create_order.html.twig', array(
            'form'       => $form->createView(),
            'flow'       => $flow,
            'admin_pool' => $this->get('sonata.admin.pool'),
            'parc_id'    => $parc,
            'month'      => date('m'),
            'year'       => date('Y'),
            'userId'     => $userId,
            'typicalDayId' => $typicalDayId,
            'user'         => $formData->order->getUser(),
            'order'        => $flow->getFormData()->order,
            'paymentForm'  => $formPayment
        ));
    }


}

/*****************************************************************************
 *
 * Classe / Class : CMCIC_Tpe
 *
 *****************************************************************************/

class CMCIC_Tpe {


    public $sVersion;	// Version du TPE - TPE Version (Ex : 3.0)
    public $sNumero;	// Numero du TPE - TPE Number (Ex : 1234567)
    public $sCodeSociete;	// Code Societe - Company code (Ex : companyname)
    public $sLangue;	// Langue - Language (Ex : FR, DE, EN, ..)
    public $sUrlOK;		// Url de retour OK - Return URL OK
    public $sUrlKO;		// Url de retour KO - Return URL KO
    public $sUrlPaiement;	// Url du serveur de paiement - Payment Server URL (Ex : https://paiement.creditmutuel.fr/paiement.cgi)

    private $_sCle;		// La cl� - The Key


    // ----------------------------------------------------------------------------
    //
    // Constructeur / Constructor
    //
    // ----------------------------------------------------------------------------

    function __construct($sLangue = "FR") {

        // contr�le de l'existence des constantes de param�trages.
        $aRequiredConstants = array('CMCIC_CLE', 'CMCIC_VERSION', 'CMCIC_TPE', 'CMCIC_CODESOCIETE');
        $this->_checkTpeParams($aRequiredConstants);

        $this->sVersion = CMCIC_VERSION;
        $this->_sCle = CMCIC_CLE;
        $this->sNumero = CMCIC_TPE;
        $this->sUrlPaiement = CMCIC_SERVEUR . CMCIC_URLPAIEMENT;

        $this->sCodeSociete = CMCIC_CODESOCIETE;
        $this->sLangue = $sLangue;

        $this->sUrlOK = CMCIC_URLOK;
        $this->sUrlKO = CMCIC_URLKO;

    }

    // ----------------------------------------------------------------------------
    //
    // Fonction / Function : getCle
    //
    // Renvoie la cl� du TPE / return the TPE Key
    //
    // ----------------------------------------------------------------------------

    public function getCle() {

        return $this->_sCle;
    }

    // ----------------------------------------------------------------------------
    //
    // Fonction / Function : _checkTpeParams
    //
    // Contr�le l'existence des constantes d'initialisation du TPE
    // Check for the initialising constants of the TPE
    //
    // ----------------------------------------------------------------------------

    private function _checkTpeParams($aConstants) {

        for ($i = 0; $i < count($aConstants); $i++)
            if (!defined($aConstants[$i]))
                die ("Erreur param�tre " . $aConstants[$i] . " ind�fini");
    }

}


/*****************************************************************************
 *
 * Classe / Class : CMCIC_Hmac
 *
 *****************************************************************************/

class CMCIC_Hmac {

    private $_sUsableKey;	// La cl� du TPE en format op�rationnel / The usable TPE key

    // ----------------------------------------------------------------------------
    //
    // Constructeur / Constructor
    //
    // ----------------------------------------------------------------------------

    function __construct($oTpe) {

        $this->_sUsableKey = $this->_getUsableKey($oTpe);
    }

    // ----------------------------------------------------------------------------
    //
    // Fonction / Function : _getUsableKey
    //
    // Renvoie la cl� dans un format utilisable par la certification hmac
    // Return the key to be used in the hmac function
    //
    // ----------------------------------------------------------------------------

    private function _getUsableKey($oTpe){

        $hexStrKey  = substr($oTpe->getCle(), 0, 38);
        $hexFinal   = "" . substr($oTpe->getCle(), 38, 2) . "00";

        $cca0=ord($hexFinal);

        if ($cca0>70 && $cca0<97)
            $hexStrKey .= chr($cca0-23) . substr($hexFinal, 1, 1);
        else {
            if (substr($hexFinal, 1, 1)=="M")
                $hexStrKey .= substr($hexFinal, 0, 1) . "0";
            else
                $hexStrKey .= substr($hexFinal, 0, 2);
        }


        return pack("H*", $hexStrKey);
    }

    // ----------------------------------------------------------------------------
    //
    // Fonction / Function : computeHmac
    //
    // Renvoie le sceau HMAC d'une chaine de donn�es
    // Return the HMAC for a data string
    //
    // ----------------------------------------------------------------------------

    public function computeHmac($sData) {

        return strtolower(hash_hmac("sha1", $sData, $this->_sUsableKey));

        // If you don't have PHP 5 >= 5.1.2 and PECL hash >= 1.1
        // you may use the hmac_sha1 function defined below
        //return strtolower($this->hmac_sha1($this->_sUsableKey, $sData));
    }

    // ----------------------------------------------------------------------------
    //
    // Fonction / Function : hmac_sha1
    //
    // RFC 2104 HMAC implementation for PHP >= 4.3.0 - Creates a SHA1 HMAC.
    // Eliminates the need to install mhash to compute a HMAC
    // Adjusted from the md5 version by Lance Rushing .
    //
    // Impl�mentation RFC 2104 HMAC pour PHP >= 4.3.0 - Cr�ation d'un SHA1 HMAC.
    // Elimine l'installation de mhash pour le calcul d'un HMAC
    // Adapt�e de la version MD5 de Lance Rushing.
    //
    // ----------------------------------------------------------------------------

    public function hmac_sha1 ($key, $data) {

        $length = 64; // block length for SHA1
        if (strlen($key) > $length) { $key = pack("H*",sha1($key)); }
        $key  = str_pad($key, $length, chr(0x00));
        $ipad = str_pad('', $length, chr(0x36));
        $opad = str_pad('', $length, chr(0x5c));
        $k_ipad = $key ^ $ipad ;
        $k_opad = $key ^ $opad;

        return sha1($k_opad  . pack("H*",sha1($k_ipad . $data)));
    }

}

// ----------------------------------------------------------------------------
// function getMethode
//
// IN:
// OUT: Donn�es soumises par GET ou POST / Data sent by GET or POST
// description: Renvoie le tableau des donn�es / Send back the data array
// ----------------------------------------------------------------------------

function getMethode()
{
    if ($_SERVER["REQUEST_METHOD"] == "GET")
        return $_GET;

    if ($_SERVER["REQUEST_METHOD"] == "POST")
        return $_POST;

    die ('Invalid REQUEST_METHOD (not GET, not POST).');
}

// ----------------------------------------------------------------------------
// function HtmlEncode
//
// IN:  chaine a encoder / String to encode
// OUT: Chaine encod�e / Encoded string
//
// Description: Encode special characters under HTML format
//                           ********************
//              Encodage des caract�res sp�ciaux au format HTML
// ----------------------------------------------------------------------------
function HtmlEncode ($data)
{
    $SAFE_OUT_CHARS = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890._-";
    $encoded_data = "";
    $result = "";
    for ($i=0; $i<strlen($data); $i++)
    {
        if (strchr($SAFE_OUT_CHARS, $data{$i})) {
            $result .= $data{$i};
        }
        else if (($var = bin2hex(substr($data,$i,1))) <= "7F"){
            $result .= "&#x" . $var . ";";
        }
        else
            $result .= $data{$i};

    }
    return $result;
}
