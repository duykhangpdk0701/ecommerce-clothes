import {
  Box,
  Button,
  Divider,
  InputLabel,
  OutlinedInput,
  Paper,
  TextField,
} from "@mui/material";
import React from "react";
import { Controller, useForm } from "react-hook-form";

const CartTotal = () => {
  const { control, handleSubmit } = useForm({
    defaultValues: {
      comment: "",
      voucher: "",
    },
  });

  const onSubmit = (data: any) => console.log(data);

  return (
    <Paper className="p-6">
      <Box component="form">
        <div className="flex justify-between items-center mb-4">
          <span className="text-[#7D879C]">Total:</span>
          <span className="font-semibold text-lg">460,00 US$</span>
        </div>
        <Divider className={"border-[#F3F5F9] mb-4"} />
        <Box className="mb-3">
          <Controller
            name="comment"
            control={control}
            render={({ field }) => (
              <>
                <InputLabel>Additional Comments</InputLabel>
                <OutlinedInput
                  {...field}
                  // className="py-2 px-3.5"
                  fullWidth
                />
              </>
            )}
          />
        </Box>
        <Divider className={"border-[#F3F5F9] mb-4"} />
        <Controller
          name="voucher"
          control={control}
          render={({ field }) => (
            <TextField
              {...field}
              label="Voucher"
              // className="py-2 px-3.5"
              fullWidth
            />
          )}
        />
        <Button className="mt-4 mb-8" fullWidth variant="outlined">
          Apply Voucher
        </Button>

        <Divider className={"border-[#F3F5F9] mb-4"} />
        <Button fullWidth variant="contained" disableElevation>
          Checkout Now
        </Button>
      </Box>
    </Paper>
  );
};

export default CartTotal;
