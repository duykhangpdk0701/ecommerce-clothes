import React, {FC} from "react";
import Paper from "@mui/material/Paper";
import Avatar from "@mui/material/Avatar";
import IPayment from "@/interfaces/Payment";
import RadioGroup from "@mui/material/RadioGroup";
import FormControlLabel from "@mui/material/FormControlLabel";
import Radio from "@mui/material/Radio";
import Button from "@mui/material/Button";
import {Controller} from "react-hook-form";
import {ICheckoutParams} from "@/pages/checkout";

import {
    Control
} from "react-hook-form/dist/types";

interface ICheckoutFormPayment {
    data?: IPayment[],
    control: Control<ICheckoutParams, any>
}

const CheckoutFormPayment: FC<ICheckoutFormPayment> = (props) => {
    const {data, control} = props;

    return (
        <Paper className="mb-6 py-6 px-7" elevation={1}>
            <div className="flex mb-7 gap-3 items-center">
                <Avatar className="bg-color-price w-8 h-8">2</Avatar>
                <p className="text-xl">Select Payment Method</p>
            </div>
            <div>
                <Controller
                    name="paymentMethod"
                    control={control}
                    render={
                        ({field}) => (
                            <RadioGroup {...field}>
                                {data?.map(item => (
                                    <FormControlLabel
                                        key={item.id}
                                        value={item.id}
                                        control={<Radio/>}
                                        label={item.name.en}/>
                                ))}
                            </RadioGroup>
                        )
                    }/>
            </div>

            <div className="mt-6">
                <Button type="submit" variant="contained" fullWidth>Place Order</Button>
            </div>
        </Paper>
    );
};

export default CheckoutFormPayment;
