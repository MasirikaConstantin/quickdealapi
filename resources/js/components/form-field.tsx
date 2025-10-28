import { PropsWithChildren } from "react";
import { cn } from "@/lib/utils";
import { Label } from "./label";

type Props = PropsWithChildren <{
    htmlFor?: string,
    label?:string,
    error?:string,
    help ?:string 
}>
    
export function FormField({children, htmlFor, label, error, help}:Props){
    return (
        <div className="space-y-2">
            <Label htmlFor={htmlFor} className={cn(error && 'text-destructive')}>{label}</Label>
            {children}
            {help &&<p className="text-sm text-muted-foreground -mt-1" >{help}</p>}
            {error &&<p className="text-sm text-destructive -mt-1">{error}</p>}
        </div> 
    )
}
    