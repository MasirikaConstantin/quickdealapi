import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import AppLayout from "@/layouts/app-layout";
import { dashboard } from "@/routes";
import produits from "@/routes/produits";
import { BreadcrumbItem, Flash, Produit } from "@/types";
import { router } from "@inertiajs/react";
import { Trash } from "lucide-react";
import { toast } from "sonner";

export default function Show({ produit,flash }: { produit: Produit,flash:Flash }) {
    const breadcrumbs : BreadcrumbItem[] = [
        { title: "Dashboard", href: dashboard().url },
        { title: "Produits", href: produits.index().url },
        { title: "Show", href: produits.show(produit.ref).url },
    ];
    if(flash.success){
        toast.success(flash.success);
    }
    if(flash.error){
        toast.error(flash.error);
    }
    //console.log(produit)
    const handleDeleteImage = (produit : number , media: number) => {
        router.visit(produits.images.delete({produit : produit,media :media}));
        
    }
    console.log(flash)
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
                    {produit.images.length > 0 &&
                    <>
                    {produit.images.map((img, index) => (
                        <div key={index} className="flex flex-row gap-4 ">
                        {img.url &&(
                            <div className="flex flex-col gap-4 relative">
                            
                                <img src={img.url} alt="Produit" className="w-64 h-64 mt-6 mb-6 " />
                                <Trash className="cursor-pointer pointer-events-auto absolute top-2 right-2" onClick={() => handleDeleteImage(produit.id,img.id)}  />
                            </div>
                        )}
                        {img.thumb &&(
                            <div className="flex flex-col gap-4 relative">
                            <Trash className="cursor-pointer pointer-events-auto absolute top-0 right-0 leading-0 left-0 p-2" onClick={() => handleDeleteImage(produit.id,img.id)} />
                            <img src={img.thumb} alt="Produit" className="w-40 h-40 mt-6 mb-6 cursor-pointer" /></div>
                        )}
                        </div>
                    ))}
                    </>
                    }
                </CardContent>
            </Card>
        </AppLayout>
    );
}