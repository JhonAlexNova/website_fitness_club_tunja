<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSmsTemplateRequest;
use App\Http\Requests\UpdateSmsTemplateRequest;
use App\Repositories\SmsTemplateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SmsTemplateController extends AppBaseController
{
    /** @var SmsTemplateRepository $smsTemplateRepository*/
    private $smsTemplateRepository;

    public function __construct(SmsTemplateRepository $smsTemplateRepo)
    {
        $this->smsTemplateRepository = $smsTemplateRepo;
    }

    /**
     * Display a listing of the SmsTemplate.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $smsTemplates = $this->smsTemplateRepository->all();

        return view('sms_templates.index')
            ->with('smsTemplates', $smsTemplates);
    }

    /**
     * Show the form for creating a new SmsTemplate.
     *
     * @return Response
     */
    public function create()
    {
        return view('sms_templates.create');
    }

    /**
     * Store a newly created SmsTemplate in storage.
     *
     * @param CreateSmsTemplateRequest $request
     *
     * @return Response
     */
    public function store(CreateSmsTemplateRequest $request)
    {
        $input = $request->all();

        $smsTemplate = $this->smsTemplateRepository->create($input);

        Flash::success('Sms Template saved successfully.');

        return redirect(route('smsTemplates.index'));
    }

    /**
     * Display the specified SmsTemplate.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $smsTemplate = $this->smsTemplateRepository->find($id);

        if (empty($smsTemplate)) {
            Flash::error('Sms Template not found');

            return redirect(route('smsTemplates.index'));
        }

        return view('sms_templates.show')->with('smsTemplate', $smsTemplate);
    }

    /**
     * Show the form for editing the specified SmsTemplate.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $smsTemplate = $this->smsTemplateRepository->find($id);

        if (empty($smsTemplate)) {
            Flash::error('Sms Template not found');

            return redirect(route('smsTemplates.index'));
        }

        return view('sms_templates.edit')->with('smsTemplate', $smsTemplate);
    }

    /**
     * Update the specified SmsTemplate in storage.
     *
     * @param int $id
     * @param UpdateSmsTemplateRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSmsTemplateRequest $request)
    {
        $smsTemplate = $this->smsTemplateRepository->find($id);

        if (empty($smsTemplate)) {
            Flash::error('Sms Template not found');

            return redirect(route('smsTemplates.index'));
        }

        $smsTemplate = $this->smsTemplateRepository->update($request->all(), $id);

        Flash::success('Sms Template updated successfully.');

        return redirect(route('smsTemplates.index'));
    }

    /**
     * Remove the specified SmsTemplate from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $smsTemplate = $this->smsTemplateRepository->find($id);

        if (empty($smsTemplate)) {
            Flash::error('Sms Template not found');

            return redirect(route('smsTemplates.index'));
        }

        $this->smsTemplateRepository->delete($id);

        Flash::success('Sms Template deleted successfully.');

        return redirect(route('smsTemplates.index'));
    }
}
