// @mui
import React, { FC, ReactElement } from "react";
import Box from "@mui/material/Box";
import Card from "@mui/material/Card";
import Paper from "@mui/material/Paper";
import Typography from "@mui/material/Typography";
import CardHeader from "@mui/material/CardHeader";
import CardContent from "@mui/material/CardContent";
// utils
import { fShortenNumber } from "@/utils/formatNumber";

// ----------------------------------------------------------------------

interface IAppTrafficBySite {
  title: string;
  subheader?: string;
  list: {
    name: string;
    value: number;
    icon: ReactElement;
  }[];
}

const AppTrafficBySite: FC<IAppTrafficBySite> = (props) => {
  const { title, subheader, list, ...other } = props;

  return (
    <Card {...other}>
      <CardHeader title={title} subheader={subheader} />

      <CardContent>
        <Box
          sx={{
            display: "grid",
            gap: 2,
            gridTemplateColumns: "repeat(2, 1fr)",
          }}
        >
          {list.map((site) => (
            <Paper
              key={site.name}
              variant="outlined"
              sx={{ py: 2.5, textAlign: "center" }}
            >
              <Box sx={{ mb: 0.5 }}>{site.icon}</Box>

              <Typography variant="h6">{fShortenNumber(site.value)}</Typography>

              <Typography variant="body2" sx={{ color: "text.secondary" }}>
                {site.name}
              </Typography>
            </Paper>
          ))}
        </Box>
      </CardContent>
    </Card>
  );
};

export default AppTrafficBySite;
