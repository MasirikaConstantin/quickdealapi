import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import AppLayout from "@/layouts/app-layout";
import { dashboard } from "@/routes";
import produits from "@/routes/produits";
import { BreadcrumbItem, Produit } from "@/types";

export default function Show({ produit }: { produit: Produit }) {
    const breadcrumbs : BreadcrumbItem[] = [
        { title: "Dashboard", href: dashboard().url },
        { title: "Produits", href: produits.index().url },
        { title: "Show", href: produits.show(produit.ref).url },
    ];
    console.log(produit)
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Card className="flex flex-col gap-4 p-6">
                <CardHeader>
                    <CardTitle>Produit</CardTitle>
                </CardHeader>
                <CardContent>
                    <p>{produit.titre}</p>
                    <p>{produit.description}</p>
                    <p>{produit.etat}</p>
                    <p>{produit.prix}</p>
                    <p>{produit.ref}</p>
                    <p>{produit.user_id}</p>
                    <p>{produit.created_at}</p>
                    <p>{produit.updated_at}</p>
                    {produit.images &&
                    <>
                    <img src={produit.images} alt="" className="w-64 h-64 mt-6 mb-6"/>
                    <img src={produit.images_thumb} alt="" className="w-40 h-40 mt-6 mb-6"/>
                    </>
                    }
                </CardContent>
            </Card>
        </AppLayout>
    );
}