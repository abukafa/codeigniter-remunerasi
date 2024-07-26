<?php

namespace App\Controllers;

use App\Models\SkimModel;
use App\Models\PotonganModel;
use App\Models\TunjanganModel;
use App\Controllers\BaseController;
use App\Models\SantriModel;
use App\Models\UserModel;

class RemunPotongan extends BaseController
{
    protected $userModel;
    protected $skimModel;
    protected $santriModel;
    protected $tunjanganModel;
    protected $potonganModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->skimModel = new SkimModel();
        $this->santriModel = new SantriModel();
        $this->tunjanganModel = new TunjanganModel();
        $this->potonganModel = new PotonganModel();
    }

    public function index()
    {
        $unlist = $this->santriModel->join('potongan', 'santri.nip = potongan.nip', 'LEFT')
            ->select('santri.id')->select('santri.nip')->select('santri.nama')->select('santri.laznah')
            ->where('santri.status_santri <> ', 'Suspend')->where('potongan.nip', NULL)->findAll();

        $distLaznah = $this->santriModel->distinct()->select('laznah')->orderby('laznah')->findAll();

        $data = [
            'santri' => $unlist,
            'laznah' => $distLaznah,
            'potongan' => $this->potonganModel->findAll(),
            'user' => $this->userModel->where('uname', session()->get('uname'))->first()
        ];
        return view('remun/potongan', $data);
    }

    public function ceklis($id)
    {
        if ($this->request->isAJAX()) {
            $potongan =  $this->potonganModel->find($id);

            if ($potongan['acc']) {
                $this->potonganModel->set('acc', false);
                $acc = false;
            } else {
                $this->potonganModel->set('acc', true);
                $acc = true;
            }

            $this->potonganModel->where('id', $id);
            $this->potonganModel->update();

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
        $data = ['potongan' => $this->potonganModel->find($id)];
        echo json_encode($data);
    }

    public function insert()
    {
        $data = [
            'id' => $this->request->getVar('id'),
            'nip' => $this->request->getVar('nip'),
            'nama' => $this->request->getVar('nama'),
            'p_srg' => (int)$this->request->getVar('p_srg'),
            'p_atr' => (int)$this->request->getVar('p_atr'),
            'p_kes' => (int)$this->request->getVar('p_kes'),
            'p_rmh' => (int)$this->request->getVar('p_rmh'),
            'p_bon' => (int)$this->request->getVar('p_bon'),
            'p_htg' => (int)$this->request->getVar('p_htg'),
            'p_zkt' => (int)$this->request->getVar('p_zkt'),
            'p_inf' => (int)$this->request->getVar('p_inf'),
            'p_lin' => (int)$this->request->getVar('p_lin')
        ];
        $this->potonganModel->insert($data);
        flash('Berhasil', 'Menambah Data Potongan..');
        return redirect()->to('/potongan');
    }

    public function update($id)
    {
        $data = [
            'nip' => $this->request->getVar('nip'),
            'nama' => $this->request->getVar('nama'),
            'p_srg' => (int)$this->request->getVar('p_srg'),
            'p_atr' => (int)$this->request->getVar('p_atr'),
            'p_kes' => (int)$this->request->getVar('p_kes'),
            'p_rmh' => (int)$this->request->getVar('p_rmh'),
            'p_bon' => (int)$this->request->getVar('p_bon'),
            'p_htg' => (int)$this->request->getVar('p_htg'),
            'p_zkt' => (int)$this->request->getVar('p_zkt'),
            'p_inf' => (int)$this->request->getVar('p_inf'),
            'p_lin' => (int)$this->request->getVar('p_lin'),
            'acc' => false
        ];
        $this->potonganModel->update($id, $data);
        flash('Berhasil', 'Mengubah Data Potongan..');
        return redirect()->to('/potongan');
    }

    public function delete($id)
    {
        $this->potonganModel->delete($id);
        flash('Berhasil', 'Menghapus Data Potongan..');
        return redirect()->to('/potongan');
    }
}
