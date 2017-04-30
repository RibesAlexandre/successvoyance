<?php
namespace App\Services;

/**
 * Class Audiotel
 * @author Alexandre Ribes
 * @package App\Services
 */
class Audiotel
{
    /**
     * Retourne la liste des consultants en format JSON
     *
     * @param string $type
     * @param string $status
     * @param string $cb
     * @return string
     */
    public function getConsultantsJson($type = 'all', $status = 'all', $cb = 'all')
    {
        $url = "https://api.audioservice.me/consultant/liste?&client=UXlWJwo1VmpRbgA8UncHMQEtWzIBZVpgUjFSdlw3USIDJlQ2DWNQOAE8Uj5VMQ%3D%3D&type_audiotel=" . $type . '&status_08=' . $status . '&status_cb=' . $cb;
        $ch_rech = curl_init();
        curl_setopt($ch_rech, CURLOPT_URL, $url);
        curl_setopt($ch_rech, CURLOPT_HEADER, 0);
        ob_start();
        curl_exec($ch_rech);
        curl_close($ch_rech);
        $json = ob_get_contents();
        ob_end_clean();

        return $json;
    }

    /**
     * Retourne la liste des consultations pour chaque voyant
     *
     * @param $nickname
     * @param string $type
     * @param null $date
     * @return string
     */
    public function getConsultationsByConsultant($nickname, $type = 'all', $date = null)
    {
        $url = 'https://api.audioservice.me/consultation/planning_get_data?&user=Bi4PfgA%2FU29TbFNvVnMHMQcrVTxVaV4xDgJTYlRrWDMCNgBqCXRWaABhA2dQNFQhDmNVdQAhCmdUYFZoXWNWbQZn&consiltant=' . $nickname . '&type=' . $type . '&format=json';
        if( !is_null($date) ) {
            $url .= '&date=' . $date;
        }

        $ch_rech = curl_init();
        curl_setopt($ch_rech, CURLOPT_URL, $url);
        curl_setopt($ch_rech, CURLOPT_HEADER, 0);
        ob_start();
        curl_exec($ch_rech);
        curl_close($ch_rech);
        $json = ob_get_contents();
        ob_end_clean();

        return $json;
    }
}