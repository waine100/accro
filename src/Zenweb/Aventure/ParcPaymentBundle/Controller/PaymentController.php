<?php

namespace Zenweb\Aventure\ParcPaymentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

require_once __DIR__.'/CMCIC_Tpe.inc.php';
require_once __DIR__.'/CMCIC_Config.php';

class PaymentController extends Controller
{
    public function PaymentAction($order = null)
    {

        $sOptions = "";

// ----------------------------------------------------------------------------
//  CheckOut Stub setting fictious Merchant and Order datas.
//  That's your job to set actual order fields. Here is a stub.
// -----------------------------------------------------------------------------

// Reference: unique, alphaNum (A-Z a-z 0-9), 12 characters max
        $sReference = $order->getReference();

// Amount : format  "xxxxx.yy" (no spaces)
        $sMontant = $order->getBaseTotal();

// Currency : ISO 4217 compliant
        $sDevise  = "EUR";

// free texte : a bigger reference, session context for the return on the merchant website
        $sTexteLibre = "ParcAventure";

// transaction date : format d/m/y:h:m:s
        $sDate = date("d/m/y:h:m:s");

// Language of the company code
        $sLangue = "FR";

// customer email
        $sEmail = "test@accro.fr";

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

        $oTpe = new \CMCIC_Tpe($sLangue);
        $oHmac = new \CMCIC_Hmac($oTpe);

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

        return $this->render('ZenwebAventureParcPaymentBundle:Form:formPayment.html.twig', array(
            'oTpe'          => $oTpe,
            'sDate'         => $sDate,
            'sMontant'      => $sMontant,
            'sDevise'       => $sDevise,
            'sReference'    => $sReference,
            'sMAC'          => $sMAC,
            'sTexteLibre'   => HtmlEncode($sTexteLibre),
            'sEmail'        => $sEmail
        ));
    }

    public function paymentErrorAction()
    {
        return $this->render('ZenwebAventureParcPaymentBundle:Default:error.html.twig');
    }

    public function paymentSuccessAction()
    {
        return $this->render('ZenwebAventureParcPaymentBundle:Default:success.html.twig');
    }

}

