<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\SeoUrl;
use Cake\Event\Event;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

/**
 * Blogs Controller
 *
 * @property \App\Model\Table\BlogsTable $Blogs
 */
class BlogsController extends AppController
{

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['index', 'view']);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('blog', $this->Blogs->find('all')->contain(['Authors', 'Categories'])->sortBy('created_at'));
        $this->set('_serialize', ['blog']);

        $categoryRegistry = TableRegistry::get('categories')->find('all')->limit(5);
        $this->set('categories', $categoryRegistry);
    }

    /**
     * View method
     *
     * @param string|null $id Blogs id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null, $slug = null)
    {
        $blog = $this->Blogs->get($id, [
            'contain' => ['Authors', 'Categories', 'Comments']
        ]);

        if($blog->status == 'auth' && !$this->Auth->user())
        {
            $this->Flash->error(__('You are not authorized to access that location.'));
            return $this->redirect(['controller' => 'Pages', 'action' => 'landing']);
        }

        if($blog->status == 'private' )
        {
            if(!$this->Blogs->isOwnedBy($id, $this->Auth->user('id'))) {
                $this->Flash->error(__('You are not authorized to access that location.'));
                return $this->redirect(['controller' => 'Pages', 'action' => 'landing']);
            }
        }

        if($blog->status == 'admin' )
        {
            if(!$this->Auth->user() || $this->Auth->user('role') != 'admin') {
                $this->Flash->error(__('You are not authorized to access that location.'));
                return $this->redirect(['controller' => 'Pages', 'action' => 'landing']);
            }
        }

        $commentRegistry = TableRegistry::get('Comments');
        $comments = $commentRegistry->findByBlogId($id)->contain(['Users']);
        $blog->comments = $comments->all()->sortBy('created_at');
        $comment = $commentRegistry->newEntity();

        if($this->request->is('post')) {
            $this->request->data['user_id'] = $this->Auth->user('id');
            $this->request->data['blog_id'] = $blog->id;

            $comment = $commentRegistry->patchEntity($comment, $this->request->data);
            if($commentRegistry->save($comment)) {
                $this->Flash->success(__('You comment has been placed!'));
                return $this->redirect(['action' => 'view', $blog->id]);
            }
            else
            {
                $this->Flash->error(__('Something went wrong. Please, try again.'));
            }
        }
        $this->set(compact('comment'));

        $this->set('blog', $blog);
        $this->set('_serialize', ['blog', 'comment']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $blog = $this->Blogs->newEntity();
        $categories = TableRegistry::get('categories')->find('all');
        if ($this->request->is('post')) {

            $this->request->data['user_id'] = $this->Auth->user('id');
            $ceo_split = str_replace(' ', '-', $this->request->data['title']);
            $ceo_split = preg_replace("/[',.!:#$%^&*()_+ \/ <>~`@']/", "", $ceo_split);
            $this->request->data['pretty_url'] = $ceo_split;
            if($this->request->data['status'] == null) {
                $this->Flash->error(__('An error has occured while parsing the status'));
                return $this->redirect(['action' => 'add']);
            }

            $blog = $this->Blogs->patchEntity($blog, $this->request->data);

            if ($this->Blogs->save($blog)) {
                $this->Flash->success(__('The blog has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The blog could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('blog'));
        $this->set('categories', $categories);
        $this->set('_serialize', ['blog']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Blogs id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $categories = TableRegistry::get('categories')->find('all');
        $blog = $this->Blogs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $blog = $this->Blogs->patchEntity($blog, $this->request->data);
            if ($this->Blogs->save($blog)) {
                $this->Flash->success(__('The blog has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The blog could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('blog'));
        $this->set('categories', $categories);
        $this->set('_serialize', ['blog']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Blogs id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $blog = $this->Blogs->get($id);
        if ($this->Blogs->delete($blog)) {
            $this->Flash->success(__('The blog has been deleted.'));
        } else {
            $this->Flash->error(__('The blog could not be deleted. Please, try again.'));
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

        $blog = $this->Blogs->find('all')->contain(['Authors', 'Categories', 'Comments']);
        $this->set('blogs', $blog);
    }
}
