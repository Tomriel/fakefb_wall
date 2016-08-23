<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;
use App\Controller\AppController;

/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 */
class PostsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */

    public function index()
    {

        $posts = $this->Posts->find('all');
        $this->set(compact('posts'));

        $allcoms = TableRegistry::get('Comments');
        $comments = $allcoms->find('all');
        $this->set(compact('comments'));
    }

    /**
     * View method
     *
     * @param string|null $id Post id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => []
        ]);

        $this->set('post', $post);
        $this->set('_serialize', ['post']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */

    public function add()
    {
        $newpost = $this->Posts->newEntity();
        if ($this->request->is('post'))
        {
            $newpost = $this->Posts->patchEntity($newpost, $this->request->data);
            $newpost->user_id = $this->Auth->user('id');
            $newpost->user_name = $this->Auth->user('username');
            if ($this->Posts->save($newpost))
            {
                $this->Flash->success(__('Votre post a bien été créé.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Impossible d\'ajouter votre post'));
            }
        }
        $this->set(compact('newpost'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Post id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $post = $this->Posts->patchEntity($post, $this->request->data);
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The post could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('post'));
        $this->set('_serialize', ['post']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Post id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id);
        if ($this->Posts->delete($post)) {
            $this->Flash->success(__('The post has been deleted.'));
        } else {
            $this->Flash->error(__('The post could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
