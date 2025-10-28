import { Button } from "@/components/ui/button";
import AppLayout from "@/layouts/app-layout";
import { dashboard } from "@/routes";
import produits, { create, destroy, edit, index, show } from "@/routes/produits";
import { Auth, type BreadcrumbItem, Produit, PaginationCollection } from "@/types";
import { Form, Head, Link, router, usePage } from "@inertiajs/react";
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { ChevronLeft, Eye, Pencil, Plus, Search, Trash2 } from "lucide-react";
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { Switch } from "@/components/ui/switch";
import { Badge } from "@/components/ui/badge";
import { AlertDialog, AlertDialogAction, AlertDialogCancel, AlertDialogContent, AlertDialogDescription, AlertDialogFooter, AlertDialogHeader, AlertDialogTitle, AlertDialogTrigger } from '@/components/ui/alert-dialog';
import { LaPagination } from "@/components/collection-pagination";
import { Input } from "@/components/ui/input";
import { FormField } from "@/components/form-field";

const breadcrumbs: BreadcrumbItem [] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
    {
        title : "Produits",
        href : produits.index().url
    }
];  
export default function EditProduits({produit}:{produit:Produit}){
    
    const handleDelete = (id: number) => {
        router.visit(destroy(id));
    };
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Les Produits"/>
                
                <div className="rounded-lg border shadow-sm">
                <div className="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <Form { ...produits.update.form({produit : produit.ref})}>
                {({errors, processing}) => (
                        <div className="flex flex-1 flex-col gap-4 p-4 md:gap-8 md:p-6">
                            <div className="flex items-center gap-4">
                                <Link href={produits.index().url}>
                                    <Button variant="outline" size="icon">
                                        <ChevronLeft className="h-4 w-4" />
                                    </Button>
                                </Link>
                                <h1 className="text-2xl font-bold tracking-tight">Image du produit  {produit.titre}</h1>
                            </div>
                            <div className="grid gap-2">
                                <FormField label='Image du produit' htmlFor='images' error={errors['images']}>
                                    <Input
                                        id="images"
                                        name='images'
                                        type="file"
                                        placeholder="Image"
                                        aria-invalid={!!errors['images']}
                                        required
                                    />
                                </FormField>
                            </div>
                            <div className="flex justify-end gap-2">
                            <Link href={produits.index.url()}>
                                <Button variant="outline">Annuler</Button>
                            </Link>
                            <Button type="submit" disabled={processing}>
                                {processing ? 'Enregistrement...' : 'Enregistrer'}
                            </Button>
                        </div>
                        </div>
                )}

                            </Form>
                        </div>
                </div>
                
                
        </AppLayout>
    )
}