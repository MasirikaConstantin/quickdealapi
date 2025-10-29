import { Button } from "@/components/ui/button";
import AppLayout from "@/layouts/app-layout";
import { dashboard } from "@/routes";
import produits, { create, destroy, edit, index, show } from "@/routes/produits";
import { Auth, type BreadcrumbItem, Produit, PaginationCollection } from "@/types";
import { Form, Head, Link, router, usePage } from "@inertiajs/react";
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Eye, Pencil, Plus, Search, Trash2 } from "lucide-react";
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { Switch } from "@/components/ui/switch";
import { Badge } from "@/components/ui/badge";
import { AlertDialog, AlertDialogAction, AlertDialogCancel, AlertDialogContent, AlertDialogDescription, AlertDialogFooter, AlertDialogHeader, AlertDialogTitle, AlertDialogTrigger } from '@/components/ui/alert-dialog';
import { LaPagination } from "@/components/collection-pagination";
import { Input } from "@/components/ui/input";

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
export default function IndexProduits({produits, search}:{produits : PaginationCollection<Produit>, search?: string}){
    const { auth } = usePage<{ auth: Auth }>().props;
    const canCreate = auth.user.role === 'admin' ;
    const canUpdate = auth.user.role === 'admin' ;
    const canDelete = auth.user.role === 'admin' ;
    const canUpdateStatus = auth.user.role === 'admin' ;
    const canViewallInfo = auth.user.role === 'admin' ;
    const handleDelete = (id: number) => {
        router.visit(destroy(id));
    };
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Les Produits"/>
            <div className="flex flex-1 flex-col gap-4 p-4 md:gap-8 md:p-6">
                <div className="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <h1 className="text-2xl font-bold tracking-tight">Gestion des produits</h1>
                    <div className="flex gap-2">
                        <div className="">
                            <Form href={index().url}  className="flex items-center gap-2"> 
                                <Input autoFocus defaultValue={search ?? ""} type="text" placeholder="Rechercher" name="search" />
                                <Button >
                                    <Search className="mr-2 h-4 w-4" />
                                    Rechercher
                                </Button>
                            </Form>
                        </div>
                            <Link href={create().url}>
                                <Button>
                                    <Plus className="mr-2 h-4 w-4" />
                                    Ajouter un produit
                                </Button>
                        </Link>
                    </div>
                </div>
                <div className="rounded-lg border shadow-sm">
                    <Table>
                        
                        <TableHeader>
                            <TableRow>
                                <TableHead className="w-12">#</TableHead>
                                <TableHead>Image</TableHead>
                                <TableHead>Nom</TableHead>
                                
                                <TableHead>Prix</TableHead>
                                <TableHead>Statut</TableHead>
                                <TableHead>Actions</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            {produits.data.map((produit: any, index: any) => {
                                const marge = produit.prix_vente - produit.prix_achat;
                                const margePourcentage = (marge / produit.prix_achat) * 100;
                                
                                return (
                                    <TableRow key={produit.id}>
                                        <TableCell className="font-medium">
                                            { produit.id}
                                        </TableCell>
                                        <TableCell>
                                            <Avatar>
                                                <AvatarImage src={produit.avatar ? `/storage/${produit.avatar}` : undefined} />
                                                <AvatarFallback>
                                                    {produit.titre.split(' ').map((n: string) => n[0]).join('')}
                                                </AvatarFallback>
                                            </Avatar>
                                        </TableCell>
                                        <TableCell className="font-medium">{produit.titre}</TableCell>
                                       
                                        <TableCell>
                                            {new Intl.NumberFormat('fr-FR', {
                                                style: 'currency',
                                                currency: 'USD'
                                            }).format(produit.prix).replace('$US', '$')}
                                        </TableCell>
                                        
                                        <TableCell>
                                            <div className="flex items-center gap-2">
                                               
                                                <Badge variant={produit.actif ? 'default' : 'secondary'}>
                                                    {produit.est_publie ? 'Actif' : 'Inactif'}
                                                </Badge>
                                            </div>
                                        </TableCell>
                                        
                                        <TableCell className="flex gap-2">
                                            <Link href={show(produit.ref)}>
                                                <Button variant="outline" size="sm">
                                                    <Eye className="h-4 w-4" />
                                                </Button>
                                            </Link>
                                            <Link href={edit(produit.ref)}>
                                                <Button variant="outline" size="sm">
                                                    <Pencil className="h-4 w-4" />
                                                </Button>
                                            </Link>
                                            <AlertDialog>
                                                <AlertDialogTrigger asChild>
                                                    <Button variant="destructive" size="sm">
                                                        <Trash2 className="h-4 w-4" />
                                                    </Button>
                                                </AlertDialogTrigger>
                                                <AlertDialogContent>
                                                    <AlertDialogHeader>
                                                        <AlertDialogTitle>Êtes-vous sûr ?</AlertDialogTitle>
                                                        <AlertDialogDescription>
                                                            Cette action supprimera définitivement le produit et ne pourra pas être annulée.
                                                        </AlertDialogDescription>
                                                    </AlertDialogHeader>
                                                    <AlertDialogFooter>
                                                        <AlertDialogCancel>Annuler</AlertDialogCancel>
                                                        <AlertDialogAction onClick={() => handleDelete(produit.id)}>
                                                            Supprimer
                                                        </AlertDialogAction>
                                                    </AlertDialogFooter>
                                                </AlertDialogContent>
                                            </AlertDialog>
                                        </TableCell>
                                    </TableRow>
                                );
                            })}
                        </TableBody>
                    </Table>
                </div>
                
                    <div className="flex items-center justify-end">
                    <LaPagination collection={produits}/>
                       
                    </div>
                
            </div>
        </AppLayout>
    )
}