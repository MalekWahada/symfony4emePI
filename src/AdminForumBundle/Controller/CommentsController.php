<?php

namespace AdminForumBundle\Controller;

use AdminForumBundle\Entity\Comments;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * Comment controller.
 *
 */
class CommentsController extends Controller
{
    /**
     * Lists all comment entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        //if($request->isXmlHttpRequest())  return new JsonResponse();
        $comments = $em->getRepository('AdminForumBundle:Comments')->findAll();
        if($request->request->count() >0 || $request->isXmlHttpRequest()){


            $ev = $this->searchComment( $request->request->get('searchAuth'));

            $cont = array();

            foreach ($ev as  $value) {
                $e = new Comments();
                $e->setIdcmmt($value['idcmmt']);
                $e->setIduser($value['idUser']);
                $e->setIdtopic($value['idTopic']);
                $e->setCmmt($value['cmmt']);
                $e->setNblikes($value['nblikes']);
                $e->setNbsignal($value['nbsignal']);


                array_push($cont, $e);
//                dump($value);
            }

            if(sizeof($cont) > 0){
               /* return $this->render('@AdminForum\Default\index.html.twig', array(
                    'comments' => $cont,
                ));*/return new JsonResponse();
            }else {
                //display message here
            }

        }
        return $this->render('@AdminForum\Default\index.html.twig', array(
            'comments' => $comments,
        ));

    }

    /**
     * Creates a new comment entity.
     *
     */
    public function newAction(Request $request)
    {
        $comment = new Comment();
        $form = $this->createForm('AdminForumBundle\Form\CommentsType', $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('comments_show', array('idcmmt' => $comment->getIdcmmt()));
        }

        return $this->render('@AdminForum\Default\new.html.twig', array(
            'comment' => $comment,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a comment entity.
     *
     */
    public function showAction(Comments $comment)
    {
        $deleteForm = $this->createDeleteForm($comment);

        return $this->render('@AdminForum\Default\show.html.twig', array(
            'comment' => $comment,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing comment entity.
     *
     */
    public function editAction(Request $request, Comments $comment)
    {
        $deleteForm = $this->createDeleteForm($comment);
        $editForm = $this->createForm('AdminForumBundle\Form\CommentsType', $comment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('comments_edit', array('idcmmt' => $comment->getIdcmmt()));
        }

        return $this->render('@AdminForum\Default\edit.html.twig', array(
            'comment' => $comment,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a comment entity.
     *
     */
    public function deleteAction(Request $request, Comments $comment)
    {
        $form = $this->createDeleteForm($comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($comment);
            $em->flush();
        }

        return $this->redirectToRoute('comments_index');
    }

    /**
     * Creates a form to delete a comment entity.
     *
     * @param Comments $comment The comment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Comments $comment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('comments_delete', array('idcmmt' => $comment->getIdcmmt())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function deleteSignalFromIndexAction(Request $request)
    {

        if($request->isXmlHttpRequest())
        {
            $l=$request->get("input");
        $em = $this->getDoctrine()->getManager();
        $post=$em->getRepository('AdminForumBundle:Comments')->find($l);
        //$em->remove($auteur);

        $em->remove($post);
        $em->flush();
       // $this->addFlash('message','Auteur supprime avec succes ');
            return new JsonResponse();

        }

        return $this->redirectToRoute('comments_index');
    }

    public function searchComment($id)
    {
        $em = $this->getDoctrine()->getManager();
        $query="SELECT * FROM `comments` WHERE cmmt like'%".$id."%'";

        $statement = $em->getConnection()->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();

//        dump($result);
        return $result;
    }
}
