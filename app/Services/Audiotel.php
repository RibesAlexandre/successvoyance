<?php
namespace App\Services;

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
        $url = "https://api.audioservice.me/?&action=consultants_liste&client=UXkFdAwzBjpVagA8UncHMVV5UThcOFpgUDMCJlc8BHcCJ1MxWDZUPAE8UT1dOQ%3D%3D&type_audiotel=" . $type . '&status_08=' . $status . '&status_cb=' . $cb;
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

    public function hey()
    {
        return 'salit';
    }
}