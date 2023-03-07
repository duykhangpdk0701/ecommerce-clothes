import Divider from "@mui/material/Divider";
import React, {FC} from "react";
import {IQuoteDetail} from "@/interfaces/Quotes";

interface ICheckoutTotal {
    quoteDetail?: IQuoteDetail[],
    subtotal?: string,
    shippingCost?: string;
    taxCost?: string;
    discount?: string;
    total?: string;
}

const CheckoutTotal: FC<ICheckoutTotal> = (props) => {
    const {quoteDetail, subtotal, shippingCost, taxCost, discount, total} = props
    return (
        <div>
            <p className="mb-4 text-sm font-bold">Your Order</p>
            {quoteDetail?.map(item => (
                <div key={item.id} className="flex items-center justify-between mb-3">
                    <p className="text-sm">
                        <span className="font-bold">{item.quantity}</span> x {item.item.name}
                    </p>
                    <p>{item.total_price} USD</p>
                </div>
            ))}
            <Divider className="my-6"/>

            <div className="flex items-center justify-between mb-1">
                <p>Subtotal:</p>
                <p className="text-sm font-bold">{subtotal} USD</p>
            </div>

            <div className="flex items-center justify-between mb-1">
                <p>Shipping:</p>
                <p className="text-sm font-bold">{shippingCost} USD</p>
            </div>

            <div className="flex items-center justify-between mb-1">
                <p>Tax:</p>
                <p className="text-sm font-bold">{taxCost} USD</p>
            </div>

            <div className="flex items-center justify-between mb-6">
                <p>Discount:</p>
                <p className="text-sm font-bold">{discount} USD</p>
            </div>
            <Divider className="mb-2"/>
            <div className="flex items-center justify-between mb-6">
                <p className="text-sm font-bold">Total</p>
                <p className="text-sm font-bold">{total} USD</p>
            </div>
        </div>
    );
};

export default CheckoutTotal;
