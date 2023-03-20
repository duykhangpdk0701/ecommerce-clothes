import React, { FC } from "react";
import dynamic from "next/dynamic";
const ReactApexChart = dynamic(() => import("react-apexcharts"), {
  ssr: false,
});
// @mui
import Card from "@mui/material/Card";
import CardHeader from "@mui/material/CardHeader";
import Box from "@mui/material/Box";
// components
import useChart from "@/components/shared/chart/useChart";

// ----------------------------------------------------------------------

interface IAppWebsiteVisits {
  title?: string;
  subheader?: string;
  chartData: {
    name: string;
    type: string;
    fill: string;
    data: number[];
  }[];
  chartLabels: string[];
}

const AppWebsiteVisits: FC<IAppWebsiteVisits> = (props) => {
  const { title, subheader, chartLabels, chartData, ...other } = props;

  const chartOptions = useChart({
    plotOptions: { bar: { columnWidth: "16%" } },
    fill: { type: chartData.map((i: any) => i.fill) },
    labels: chartLabels,
    xaxis: { type: "datetime" },
    tooltip: {
      shared: true,
      intersect: false,
      y: {
        formatter: (y: any) => {
          if (typeof y !== "undefined") {
            return `${y.toFixed(0)} visits`;
          }
          return y;
        },
      },
    },
  });

  return (
    <Card {...other}>
      <CardHeader title={title} subheader={subheader} />

      <Box sx={{ p: 3, pb: 1 }} dir="ltr">
        <ReactApexChart
          type="line"
          series={chartData}
          options={chartOptions}
          height={364}
          width={"100%"}
        />
      </Box>
    </Card>
  );
};

export default AppWebsiteVisits;
