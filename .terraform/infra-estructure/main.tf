locals {
  cidr                  = var.cidrs[var.env]
  database_subnet_cidrs = [for k, v in local.azs : cidrsubnet(local.cidr, 8, k + (length(local.azs) * 2))]
  env                   = var.env
  key_name              = "${var.env}-${var.name}"
  name                  = "application"
  private_subnet_cidrs  = [for k, v in local.azs : cidrsubnet(local.cidr, 8, k)]
  public_subnet_cidrs   = [for k, v in local.azs : cidrsubnet(local.cidr, 8, k + length(local.azs))]
  region                = "us-east-1"
  tags = {
    azs         = slice(data.aws_availability_zones.available.names, 0, (var.env == "main" ? 6 : 3))
    CostCenter  = "Engineer"
    Environment = local.env
    ManagedBy   = "Terraform"
  }
}