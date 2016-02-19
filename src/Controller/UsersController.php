<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['add', 'logout', 'forgot', 'view']);

        if($this->request->action == 'login' || $this->request->action == 'add' || $this->request->action == 'forgot')
        {
            if($this->Auth->user())
            {
                $this->Flash->error(__("You are already logged in."));
                return $this->redirect(['controller' => 'Pages', 'action' => 'landing']);
            }
        }

    }
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->redirect('/');

        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect('/');
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
    */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Blogs', 'Comments', 'ProfileMessages']
        ]);

        $profileMessageRegistry = TableRegistry::get('ProfileMessages');
        $profileMessage = $profileMessageRegistry->newEntity();

        $user->profileMessages = $profileMessageRegistry->findByProfileId($id)->contain(['Users'])->all()->sortBy('created_at');

        if($this->request->is('post')) {
            $this->request->data['profile_id'] = $user->id;
            $this->request->data['poster_id'] = $this->Auth->user('id');

            $profileMessage = $profileMessageRegistry->patchEntity($profileMessage, $this->request->data);
            if($profileMessageRegistry->save($profileMessage)) {
                $this->Flash->success(__('You comment has been placed!'));
                return $this->redirect(['action' => 'view', $user->id]);
            }
            else
            {
                $this->Flash->error(__('Something went wrong. Please, try again.'));
            }
        }

        $this->set('profile', $user);
        $this->set('profileMessage', $profileMessage);
        $this->set('_serialize', ['profile', 'profileMessage']);
    }


    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     *
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     *
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
     * */
}
