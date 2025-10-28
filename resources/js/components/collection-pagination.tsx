import { PaginationCollection } from "@/types";
import { Link } from "@inertiajs/react";
import { Button } from "./ui/button";
import { ReactNode } from "react";
import { ChevronLeft, ChevronLeftIcon, ChevronRightIcon, icons } from "lucide-react";

type Props = {collection : PaginationCollection<unknown>}
export function LaPagination({collection} : Props){
    return (
        <div className="flex items-center justify-between">
            <div className="text-muted-foreground hidden flex-1 text-sm lg:flex">
                Page {collection.meta.current_page} sur  {collection.meta.last_page}
            </div>
            <nav role="navigation" aria-label="Pagination" >
                <ul className="flex items-center gap-1">
                    {collection.meta.links.map((link, index)=>(
                        <li key={index}>
                            <Button 
                                variant={link.active ? 'outline' : 'ghost'} 
                                disabled={link.url === null} 
                                asChild
                                aria-current={link.active ? 'page' : undefined}
                                data-active={link.active}
                                size='icon'
                                >
                                <Link href={link.url ?? '#'} >
                                    {label(link.label,index,collection.meta.links.length)}
                                </Link>
                            </Button>
                        </li>
                    ))}
                </ul>
            </nav>
        </div>
)}

function label(s :string , index :number ,count :number):ReactNode{
    if(index === 0){
        return <ChevronLeftIcon/>
    }
    if(index === count - 1){
        return <ChevronRightIcon/>
    }
    return s;
}
    