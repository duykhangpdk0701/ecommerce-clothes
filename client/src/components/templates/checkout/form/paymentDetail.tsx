import React, { FC } from "react";
import Paper from "@mui/material/Paper";
import Avatar from "@mui/material/Avatar";
import IPayment from "@/interfaces/Payment";
import RadioGroup from "@mui/material/RadioGroup";
import FormControlLabel from "@mui/material/FormControlLabel";
import Radio from "@mui/material/Radio";
import { Controller } from "react-hook-form";
import { ICheckoutParams } from "@/pages/checkout";
import { Control } from "react-hook-form/dist/types";
import LoadingButton from "@mui/lab/LoadingButton";

interface ICheckoutFormPayment {
  data?: IPayment[];
  control: Control<ICheckoutParams, any>;
  loadingSubmit: boolean;
}

const CheckoutFormPayment: FC<ICheckoutFormPayment> = (props) => {
  const { data, control, loadingSubmit } = props;

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
          render={({ field }) => (
            <RadioGroup {...field}>
              {data?.map((item) => (
                <FormControlLabel
                  key={item.id}
                  value={item.id}
                  control={<Radio />}
                  label={item.name.en}
                />
              ))}
            </RadioGroup>
          )}
        />
      </div>

      <div className="mt-6">
        <LoadingButton
          type="submit"
          variant="contained"
          fullWidth
          loading={loadingSubmit}
        >
          Place Order
        </LoadingButton>
      </div>
    </Paper>
  );
};

export default CheckoutFormPayment;
