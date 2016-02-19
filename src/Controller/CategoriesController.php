<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable Categories
 */
class CategoriesController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Auth->deny('add');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('categories', $this->paginate($this->Categories));
        $this->set('_serialize', ['category']);
    }

    /**
     * View method
     *
     * @param string|null $id Categories id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $category = $this->Categories->get($id, [
            'contain' => []
        ]);
        $this->set('category', $category);
        $this->set('_serialize', ['category']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if($this->Auth->user('role') != 'admin')
        {
            $this->Flash->error(__('You are not authorized to access that location.'));
            return $this->redirect(['controller' => 'Pages', 'action' => 'landing']);
        }

        $category = $this->Categories->newEntity();
        if ($this->request->is('post')) {
            $category = $this->Categories->patchEntity($category, $this->request->data);
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('category'));
        $this->set('_serialize', ['category']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Categories id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if($this->Auth->user('role') != 'admin')
        {
            $this->Flash->error(__('You are not authorized to access that location.'));
            return $this->redirect(['controller' => 'Pages', 'action' => 'landing']);
        }

        $category = $this->Categories->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $category = $this->Categories->patchEntity($category, $this->request->data);
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('category'));
        $this->set('_serialize', ['category']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Categories id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if($this->Auth->user('role') != 'admin')
        {
            $this->Flash->error(__('You are not authorized to access that location.'));
            return $this->redirect(['controller' => 'Pages', 'action' => 'landing']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $category = $this->Categories->get($id);
        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function admin()
    {
        if(!$this->Auth->user() && $this->Auth->user('role') != 'admin')
        {
            $this->Flash->error(__('You are not allowed to view this location'));
            return $this->redirect(['action' => 'admin']);
        }

        $blog = $this->Categories->find('all');
        $this->set('blogs', $blog);
    }
}
