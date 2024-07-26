<?php

namespace App\Controllers;

use App\Models\SkimModel;
use App\Models\SantriModel;
use App\Models\PotonganModel;
use App\Models\TunjanganModel;
use App\Controllers\BaseController;
use App\Models\UserModel;

class RemunTunjangan extends BaseController
{
    protected $userModel;
    protected $skimModel;
    protected $santriModel;
    protected $tunjanganModel;
    protected $potonganModel;

    public function __construct()
    {
        $this->skimModel = new SkimModel();
        $this->santriModel = new SantriModel();
        $this->tunjanganModel = new TunjanganModel();
        $this->potonganModel = new PotonganModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $unlist = $this->santriModel->join('tunjangan', 'santri.nip = tunjangan.nip', 'LEFT')
            ->select('santri.id')->select('santri.nip')->select('santri.nama')->select('santri.laznah')
            ->where('santri.status_santri <> ', 'Suspend')->where('tunjangan.nip', NULL)->findAll();

        $distLaznah = $this->santriModel->distinct()->select('laznah')->orderby('laznah')->findAll();

        $data = [
            'santri' => $unlist,
            'laznah' => $distLaznah,
            'tunjangan' => $this->tunjanganModel->findAll(),
            'user' => $this->userModel->where('uname', session()->get('uname'))->first()
        ];
        // dd($data);
        return view('remun/tunjangan', $data);
    }

    public function ceklis($id)
    {
        if ($this->request->isAJAX()) {
            $tunjangan =  $this->tunjanganModel->find($id);

            if ($tunjangan['acc']) {
                $this->tunjanganModel->set('acc', false);
                $acc = false;
            } else {
                $this->tunjanganModel->set('acc', true);
                $acc = true;
            }

            $this->tunjanganModel->where('id', $id);
            $this->tunjanganModel->update();

            echo json_encode($acc);
        } else {
            exit('Maaf Tidak dapat diproses');
        }
    }

    public function santri($id)
    {
        $data = ['santri' => $this->santriModel->find($id)];
        echo json_encode($data);
    }

    public function data($id)
    {
        $tunj = $this->tunjanganModel->find($id);
        $data = [
            'tunjangan' => $tunj,
            'santri' => $this->santriModel->where('nip', $tunj['nip'])->first(),
        ];
        echo json_encode($data);
    }

    public function insert()
    {
        $data = [
            'id' => $this->request->getVar('id'),
            'nip' => $this->request->getVar('nip'),
            'nama' => $this->request->getVar('nama'),
            't_jab' => (int)$this->request->getVar('t_jab'),
            't_stt' => (int)$this->request->getVar('t_stt'),
            't_ank' => (int)$this->request->getVar('t_ank'),
            't_rmh' => (int)$this->request->getVar('t_rmh'),
            't_prg' => (int)$this->request->getVar('t_prg'),
            't_srg' => (int)$this->request->getVar('t_srg'),
            't_atr' => (int)$this->request->getVar('t_atr'),
            't_kes' => (int)$this->request->getVar('t_kes'),
            't_hra' => (int)$this->request->getVar('t_hra'),
            't_haj' => (int)$this->request->getVar('t_haj'),
            't_dka' => (int)$this->request->getVar('t_dka'),
            't_bns' => (int)$this->request->getVar('t_bns'),
            't_spc' => (int)$this->request->getVar('t_spc'),
            't_eks' => (int)$this->request->getVar('t_eks')
        ];
        $this->tunjanganModel->insert($data);
        flash('Berhasil', 'Menambah Data Tunjangan..');
        return redirect()->to('/tunjangan');
    }

    public function update($id)
    {
        $data = [
            'nip' => $this->request->getVar('nip'),
            'nama' => $this->request->getVar('nama'),
            't_jab' => (int)$this->request->getVar('t_jab'),
            't_stt' => (int)$this->request->getVar('t_stt'),
            't_ank' => (int)$this->request->getVar('t_ank'),
            't_rmh' => (int)$this->request->getVar('t_rmh'),
            't_prg' => (int)$this->request->getVar('t_prg'),
            't_srg' => (int)$this->request->getVar('t_srg'),
            't_atr' => (int)$this->request->getVar('t_atr'),
            't_kes' => (int)$this->request->getVar('t_kes'),
            't_hra' => (int)$this->request->getVar('t_hra'),
            't_haj' => (int)$this->request->getVar('t_haj'),
            't_dka' => (int)$this->request->getVar('t_dka'),
            't_bns' => (int)$this->request->getVar('t_bns'),
            't_spc' => (int)$this->request->getVar('t_spc'),
            't_eks' => (int)$this->request->getVar('t_eks'),
            'acc' => false
        ];
        $this->tunjanganModel->update($id, $data);
        $dataPot = [
            'nip' => $this->request->getVar('nip'),
            'nama' => $this->request->getVar('nama'),
            'p_srg' => (int)$this->request->getVar('t_srg'),
            'p_atr' => (int)$this->request->getVar('t_atr'),
            'p_kes' => (int)$this->request->getVar('t_kes'),
            'p_rmh' => (int)$this->request->getVar('t_rmh'),
        ];
        $pot = $this->potonganModel->where('nip', $data['nip'])->first();
        if ($pot) {
            $this->potonganModel->update($pot['id'], $dataPot);
        } else {
            $this->potonganModel->insert($dataPot);
        }

        flash('Berhasil', 'Mengubah Data Tunjangan..');
        return redirect()->to('/tunjangan');
    }

    public function delete($id)
    {
        $this->tunjanganModel->delete($id);
        flash('Berhasil', 'Menghapus Data Tunjangan..');
        return redirect()->to('/tunjangan');
    }
}
