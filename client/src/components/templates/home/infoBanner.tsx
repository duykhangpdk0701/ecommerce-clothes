import { Grid } from "@mui/material";
import React from "react";
import DeliveryIcon from "../../../assets/home/delivery";
import MoneyGuaranteeIcon from "../../../assets/home/MoneyGuaranteeIcon";
import PaymentIcon from "../../../assets/home/PaymentIcon";
import ReturnIcon from "../../../assets/home/returnIcon";
import { DIVIDER_COLOR_GRAY, TEXT_COLOR_GRAY } from "@/styles/color";

const InfoBanner = () => {
  return (
    <div className="bg-white">
      <div className="py-8">
        <Grid container>
          <Grid item xs={6} md={3}>
            <div
              className="flex justify-center gap-4 border-0 border-r border-solid"
              style={{ borderColor: DIVIDER_COLOR_GRAY }}
            >
              <DeliveryIcon className="text-[40px]" />
              <div>
                <h4 className="text-lg font-semibold">Fast Delivery</h4>
                <span className="text-sm" style={{ color: TEXT_COLOR_GRAY }}>
                  Star from $10
                </span>
              </div>
            </div>
          </Grid>

          <Grid item xs={6} md={3}>
            <div
              className="flex justify-center gap-4 md:border-0 md:border-r md:border-solid"
              style={{ borderColor: DIVIDER_COLOR_GRAY }}
            >
              <MoneyGuaranteeIcon className="text-[40px]" />
              <div>
                <h4 className="text-lg font-semibold">Money Guarantee</h4>
                <span className="text-sm" style={{ color: TEXT_COLOR_GRAY }}>
                  7 Days Back
                </span>
              </div>
            </div>
          </Grid>
          <Grid item xs={6} md={3}>
            <div
              className="flex justify-center gap-4 border-0 border-r border-solid"
              style={{ borderColor: DIVIDER_COLOR_GRAY }}
            >
              <ReturnIcon className="text-[40px]" />
              <div>
                <h4 className="text-lg font-semibold">365 Days</h4>
                <span className="text-sm" style={{ color: TEXT_COLOR_GRAY }}>
                  For free return
                </span>
              </div>
            </div>
          </Grid>
          <Grid item xs={6} md={3}>
            <div
              className="flex justify-center gap-4"
              style={{ borderColor: DIVIDER_COLOR_GRAY }}
            >
              <PaymentIcon className="text-[40px]" />
              <div>
                <h4 className="text-lg font-semibold">Payment</h4>
                <span className="text-sm" style={{ color: TEXT_COLOR_GRAY }}>
                  Secure system
                </span>
              </div>
            </div>
          </Grid>
        </Grid>
      </div>
    </div>
  );
};

export default InfoBanner;
