<?php

namespace App\Controller;

use App\Model\Citizen;
use App\Repository\CitizenRepository;
use App\View\CitizenView;
use App\Util\NisUtil;
use Exception;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CitizenController
{
    private CitizenRepository $citizenRepo;
    private CitizenView $citizenView;
    private NisUtil $nisUtil;

    public function __construct(CitizenRepository $citizenRepo, CitizenView $citizenView, NisUtil $nisUtil)
    {
        $this->citizenRepo = $citizenRepo;
        $this->citizenView = $citizenView;
        $this->nisUtil = $nisUtil;
    }

    /**
     * @throws Exception
     */
    public function addCitizen(Request $request): Response
    {
        $data = json_decode($request->getBody()->getContents(), true);
        $newCitizen = new Citizen($data['name']);
        $this->citizenRepo->addCitizen($newCitizen);

        return new Response(200, [], $this->citizenView->displaySuccessMessage($newCitizen));
    }

    /**
     * @throws Exception
     */
    public function searchCitizenByNis(Request $request): Response
    {
        $nis = $request->getAttribute('nis');
        $searchedCitizen = $this->citizenRepo->getCitizenByNis($nis);

        return new Response(200, [], $this->citizenView->displayCitizen($searchedCitizen));
    }

    public function verifyNis(Request $request): Response
    {
        $nis = $request->getAttribute('nis');
        $valid = $this->nisUtil->validateNis($nis);

        if(!$this->nisUtil->validateNis($nis)) {
            return new Response(400, [], $this->citizenView->displayNisVerification($valid));
        } else {
            return new Response(200, [], $this->citizenView->displayNisVerification($valid));
        }
    }
}
