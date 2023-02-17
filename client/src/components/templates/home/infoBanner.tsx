import Grid from "@mui/material/Grid";
import React from "react";
import DeliveryIcon from "../../../assets/home/delivery";
import MoneyGuaranteeIcon from "../../../assets/home/MoneyGuaranteeIcon";
import PaymentIcon from "../../../assets/home/PaymentIcon";
import ReturnIcon from "../../../assets/home/returnIcon";

const InfoBanner = () => {
  return (
    <div className="bg-white">
      <div className="py-8">
        <Grid container>
          <Grid item xs={6} md={3}>
            <div className="flex justify-center gap-4 border-0 border-r border-solid bg-col border-color-gray">
              <DeliveryIcon className="text-[40px]" />
              <div>
                <h4 className="text-lg font-semibold">Fast Delivery</h4>
                <span className="text-sm text-color-gray">Star from $10</span>
              </div>
            </div>
          </Grid>

          <Grid item xs={6} md={3}>
            <div className="flex justify-center gap-4 md:border-0 md:border-r md:border-solid border-color-gray">
              <MoneyGuaranteeIcon className="text-[40px]" />
              <div>
                <h4 className="text-lg font-semibold">Money Guarantee</h4>
                <span className="text-sm text-color-gray">7 Days Back</span>
              </div>
            </div>
          </Grid>
          <Grid item xs={6} md={3}>
            <div className="flex justify-center gap-4 border-0 border-r border-solid border-color-gray">
              <ReturnIcon className="text-[40px]" />
              <div>
                <h4 className="text-lg font-semibold">365 Days</h4>
                <span className="text-sm text-color-gray">For free return</span>
              </div>
            </div>
          </Grid>
          <Grid item xs={6} md={3}>
            <div className="flex justify-center gap-4 border-color-gray">
              <PaymentIcon className="text-[40px]" />
              <div>
                <h4 className="text-lg font-semibold">Payment</h4>
                <span className="text-sm text-color-gray">Secure system</span>
              </div>
            </div>
          </Grid>
        </Grid>
      </div>
    </div>
  );
};

export default InfoBanner;
