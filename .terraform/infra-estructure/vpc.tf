# module "vpc" {
#   source  = "terraform-aws-modules/vpc/aws"
#   version = "5.2.0"

#   azs  = local.azs
#   cidr = local.cidr
#   name = "${local.env}-${local.name}-vpc"

#   database_subnets = local.database_subnet_cidrs
#   private_subnets  = local.private_subnet_cidrs
#   public_subnets   = local.public_subnet_cidrs

#   database_subnet_names = ["Subnet banco um"]
#   private_subnet_names  = ["Subnet privada um", "Subnet privada dois"]
#   public_subnet_names   = ["Subnet pública um", "Subnet pública dois", "Subnet pública três"]

#   enable_dns_hostnames = true
#   enable_dns_support   = true

#   enable_flow_log                      = true
#   create_flow_log_cloudwatch_log_group = true
#   create_flow_log_cloudwatch_iam_role  = true
#   flow_log_max_aggregation_interval    = 60

#   enable_dhcp_options = true

#   enable_nat_gateway = false
#   single_nat_gateway = false

#   tags = merge(local.tags, {
#     Name = "${local.env}-${local.name}"
#   })

#   igw_tags = merge(local.tags, {
#     Name = "${local.env}-${local.name}-igw"
#     Type = "database"
#   })

#   nat_gateway_tags = merge(local.tags, {
#     Name = "${local.env}-${local.name}-ngw"
#     Type = "database"
#   })

#   default_route_table_tags = merge(local.tags, {
#     Name = "${local.env}-${local.name}-rt-default"
#   })

#   database_subnet_tags = merge(local.tags, {
#     Name = "${local.env}-${local.name}-subnet-database"
#     Type = "database"
#   })
#   database_route_table_tags = merge(local.tags, {
#     Name = "${local.env}-${local.name}-rt-database"
#   })

#   private_subnet_tags = merge(local.tags, {
#     Name = "${local.env}-${local.name}-subnet-private"
#     Type = "private"
#   })
#   private_route_table_tags = merge(local.tags, {
#     Name = "${local.env}-${local.name}-rt-private"
#   })

#   public_subnet_tags = merge(local.tags, {
#     Name = "${local.env}-${local.name}-subnet-public"
#     Type = "public"
#   })
#   public_route_table_tags = merge(local.tags, {
#     Name = "${local.env}-${local.name}-rt-public"
#   })
# }