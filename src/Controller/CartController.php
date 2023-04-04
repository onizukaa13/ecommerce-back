<?php

namespace App\Controller;

use App\Entity\CartItem;
use App\Entity\Product;
use App\Repository\CartItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart/add-item", name="cart_add_item", methods={"POST"})
     */
    public function addItem(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $productId = $request->request->get('productId');
        $quantity = $request->request->get('quantity');

        // Rechercher l'article dans la base de données
        $product = $entityManager->getRepository(Product::class)->find($productId);

        if (!$product) {
            return $this->json([
                'message' => 'Product not found'
            ], 404);
        }

        // Rechercher l'élément de panier existant pour le même produit et le même utilisateur
        $cartItem = $entityManager->getRepository(CartItem::class)->findOneBy([
            'user' => $this->getUser(),
            'product' => $product
        ]);

        if ($cartItem) {
            // Si l'élément de panier existe déjà, mettre à jour la quantité
            $cartItem->setQuantity($cartItem->getQuantity() + $quantity);
        } else {
            // Sinon, créer un nouvel élément de panier
            $cartItem = new CartItem();
            $cartItem->setProduct($product);
            $cartItem->setQuantity($quantity);
            $cartItem->setUser($this->getUser());
        }

        // Enregistrer l'élément de panier dans la base de données
        $entityManager->persist($cartItem);
        $entityManager->flush();

        return $this->json([
            'message' => 'Item added to cart'
        ]);
    }

    /**
     * @Route("/cart", name="cart_view", methods={"GET"})
     */
    public function viewCart(CartItemRepository $cartItemRepository): JsonResponse
    {
        $cartItems = $cartItemRepository->findBy([
            'user' => $this->getUser()
        ]);

        $data = [];
        foreach ($cartItems as $cartItem) {
            $data[] = [
                'productId' => $cartItem->getProduct()->getId(),
                'productName' => $cartItem->getProduct()->getName(),
                'quantity' => $cartItem->getQuantity(),
                'price' => $cartItem->getProduct()->getPrice(),
                'totalPrice' => $cartItem->getTotalPrice(),
            ];
        }

        return $this->json($data);
    }

    /**
     * @Route("/cart/remove-item/{id}", name="cart_remove_item", methods={"DELETE"})
     */
    public function removeItem(CartItem $cartItem, EntityManagerInterface $entityManager): JsonResponse
    {
        // Vérifier que l'élément de panier appartient à l'utilisateur actuellement connecté
        if ($cartItem->getUser() !== $this->getUser()) {
            return $this->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        // Supprimer l'élément de panier de la base de données
        $entityManager->remove($cartItem);
        $entityManager->flush();

        return $this->json([
            'message' => 'Item removed from cart'
        ]);
    }
}
