<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInstructorRequest;
use App\Http\Requests\UpdateInstructorRequest;
use App\Repositories\InstructorRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Storage;

use Hash;

use App\Models\TipoUsuario;

class InstructorController extends AppBaseController
{
    /** @var InstructorRepository $instructorRepository*/
    private $instructorRepository;

    public function __construct(InstructorRepository $instructorRepo)
    {
        $this->instructorRepository = $instructorRepo;
    }

    /**
     * Display a listing of the Instructor.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $instructors = $this->instructorRepository->withRelations();
        

        return view('instructors.index')
            ->with('instructors', $instructors);
    }

    /**
     * Show the form for creating a new Instructor.
     *
     * @return Response
     */
    public function create()
    {
        return view('instructors.create');
    }

    /**
     * Store a newly created Instructor in storage.
     *
     * @param CreateInstructorRequest $request
     *
     * @return Response
     */
    public function store(CreateInstructorRequest $request)
    {
        $input = $request->all();
        $input["tipo"] = "Instructor";

        if($request->file("file_foto_perfil")){
            $input["foto_perfil"] = Storage::disk("public")->putFile("avatar/instructor",$request->file_foto_perfil);
        }

        $input['password'] = Hash::make($request->documento);

        $instructor = $this->instructorRepository->create($input);

            TipoUsuario::create([
                'rol_id' => 3,
                'user_id' => $instructor->id
            ]);
      //  dd($input,$instructor);

        Flash::success('Instructor saved successfully.');

        return redirect(route('instructors.index'));
    }

    /**
     * Display the specified Instructor.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $instructor = $this->instructorRepository->find($id);

        if (empty($instructor)) {
            Flash::error('Instructor not found');

            return redirect(route('instructors.index'));
        }

        return view('instructors.show')->with('instructor', $instructor);
    }

    /**
     * Show the form for editing the specified Instructor.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $instructor = $this->instructorRepository->find($id);

        if (empty($instructor)) {
            Flash::error('Instructor not found');

            return redirect(route('instructors.index'));
        }

        return view('instructors.edit')->with('instructor', $instructor);
    }

    /**
     * Update the specified Instructor in storage.
     *
     * @param int $id
     * @param UpdateInstructorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInstructorRequest $request)
    {
        $instructor = $this->instructorRepository->find($id);

        if (empty($instructor)) {
            Flash::error('Instructor not found');

            return redirect(route('instructors.index'));
        }



        if($request->file("file_foto_perfil")){
            $request["foto_perfil"] = Storage::disk("public")->putFile("avatar/instructor",$request->file_foto_perfil);
        }

        if($request["new-password"]){
            $request["password"] = Hash::make($request["new-password"]);
        }


        $instructor = $this->instructorRepository->update($request->all(), $id);

        Flash::success('Instructor updated successfully.');

        return redirect(route('instructors.index'));
    }

    /**
     * Remove the specified Instructor from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $instructor = $this->instructorRepository->find($id);

        if (empty($instructor)) {
            Flash::error('Instructor not found');

            return redirect(route('instructors.index'));
        }

        $this->instructorRepository->delete($id);

        Flash::success('Instructor deleted successfully.');

        return redirect(route('instructors.index'));
    }
}
